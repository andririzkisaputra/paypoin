<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\helpers\Url;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Tagihan;
use common\models\Category;
use common\models\Layanan;
use common\models\Product;
use common\models\FileUpload;
use common\components\PayPoinApi;
use common\components\Library;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\TagihanForm;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $modelKategori = Category::find()->where(['order' => 'voucher'])->groupBy(['real'])->orderBy(['order' => SORT_ASC])->all();
        
        $result['modelKategori'] = $modelKategori;
        return $this->render('index', $result);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionCekNotelp()
    {
        $id   = Yii::$app->request->post('id');
        $type = Yii::$app->request->post('type');
        $data_produk = Product::findAll([
            'type'  => $type, 
            'brand' => $id
        ]);
        $data        = [];
        if (count($data_produk) > 0) {
            foreach ($data_produk as $key => $value) {
                $data[] = [
                    'code'    => $value->code,
                    'name'    => $value->name,
                    'price'   => $value->price,
                    'price_f' => (new Library)->getFormatRupiah($value->price),
                ];
                // $data_produk[$key]['gambar_link']   = Yii::getAlias('@common/uploads/layanan/'.$value['file_name']);
            }    
        }
        $result['data'] = $data;
        return json_encode($result);
    }

    public function actionImage($img)
    {
        $imgFullPath = Yii::getAlias('@common/uploads/kategori/'.$img);
        $response = Yii::$app->getResponse();
        $response->headers->set('Content-Type', ['image/png']);
        $response->format = Response::FORMAT_RAW;

        if (!is_resource($response->stream = fopen($imgFullPath, 'r'))) {
            throw new \yii\web\ServerErrorHttpException('file access failed: permission deny');
        }
        return $response->send();
    }

    public function actionImageLayanan($session_upload_id)
    {
        $model = FileUpload::findOne(['session_upload_id' => $session_upload_id]);
        $imgFullPath = Yii::getAlias('@common/uploads/layanan/'.$model->file_name);
        $response = Yii::$app->getResponse();
        $response->headers->set('Content-Type', ['image/png']);
        $response->format = Response::FORMAT_RAW;

        if (!is_resource($response->stream = fopen($imgFullPath, 'r'))) {
            throw new \yii\web\ServerErrorHttpException('file access failed: permission deny');
        }

        return $response->send();
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    // public function actionLogin()
    // {
    //     if (!Yii::$app->user->isGuest) {
    //         return $this->goHome();
    //     }

    //     $model = new LoginForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->login()) {
    //         return $this->goBack();
    //     }

    //     $model->password = '';

    //     return $this->render('login', [
    //         'model' => $model,
    //     ]);
    // }
    
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    // public function actionSignup()
    // {
    //     $model = new SignupForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->signup()) {
    //         Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
    //         return $this->goHome();
    //     }

    //     return $this->render('signup', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
