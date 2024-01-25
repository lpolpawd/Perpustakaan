<?php

namespace app\controllers;

use app\models\AdminLoginForm;
use app\models\Anggota;
use app\models\LoginForm;
use app\models\Peminjamen;
use app\models\ReviewBuku;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\IdentityInterface;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\Bukus;
use app\models\Admin;
use app\models\User;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
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
     * @return string
     */
    public function actionIndex()
    {
        $bukus = Bukus::find()->all();

        return $this->render('index', ['bukus' => $bukus]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', 'Login successful!');
            return $this->goHome();
        } else {
            if (Yii::$app->request->isPost) {
                Yii::$app->session->setFlash('error', 'Username or password is incorrect.');
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        $model = new Anggota(); // Ganti dengan model yang sesuai

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Sign up successful!');
                return $this->redirect(['site/login']); // Redirect ke halaman login setelah sign up berhasil
            } else {
                Yii::$app->session->setFlash('error', 'Failed to save data.');
                // Handle error saving data to database
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionBook($id)
    {
        $viewNames = ['book1', 'book2', 'book3'];
        $viewName = Yii::$app->request->get('view', 'defaultView'); // 'defaultView' is a fallback if 'view' parameter is not provided

        if (in_array($viewName, $viewNames)) {
            return $this->render($viewName, ['id' => $id]);
        } else {
            return $this->render('notFound'); // Tambahkan halaman notFound jika view tidak sesuai
        }
    }


    public function actionBook29()
    {

        $id = 29;
        $bukus = Bukus::find()->where(['id' => $id])->one();
        $reviews = ReviewBuku::find()->where(['bukus_id' => $id])->all();

        $newReview = new ReviewBuku(); // Inisialisasi objek untuk ulasan baru
        $userId = Yii::$app->user->isGuest ? null : Yii::$app->user->id;

        if ($newReview->load(Yii::$app->request->post())) {
            // Setel ID pengguna yang sudah login ke atribut anggota_id pada model ReviewBuku
            $newReview->anggota_id = $userId;
            $newReview->bukus_id = $id; // Atur ID buku

            if ($newReview->save()) {
                Yii::$app->session->setFlash('success', 'Review berhasil disimpan.');
                return $this->refresh(); // Refresh halaman setelah penyimpanan berhasil
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan ulasan.');
                // Handle error saving data to database
            }
        }

        return $this->render('book29', [
            'bukus' => $bukus,
            'reviews' => $reviews,
            'newReview' => $newReview,
            'userId' => $userId
        ]);

    }

    public function actionBook30()
    {

        $id = 30;
        $bukus = Bukus::find()->where(['id' => $id])->one();
        $reviews = ReviewBuku::find()->where(['bukus_id' => $id])->all();

        $newReview = new ReviewBuku(); // Inisialisasi objek untuk ulasan baru
        $userId = Yii::$app->user->isGuest ? null : Yii::$app->user->id;

        if ($newReview->load(Yii::$app->request->post())) {
            // Setel ID pengguna yang sudah login ke atribut anggota_id pada model ReviewBuku
            $newReview->anggota_id = $userId;
            $newReview->bukus_id = $id; // Atur ID buku

            if ($newReview->save()) {
                Yii::$app->session->setFlash('success', 'Review berhasil disimpan.');
                return $this->refresh(); // Refresh halaman setelah penyimpanan berhasil
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan ulasan.');
                // Handle error saving data to database
            }
        }

        return $this->render('book30', [
            'bukus' => $bukus,
            'reviews' => $reviews,
            'newReview' => $newReview,
            'userId' => $userId
        ]);

    }

    public function actionBook31()
    {

        $id = 31;
        $bukus = Bukus::find()->where(['id' => $id])->one();
        $reviews = ReviewBuku::find()->where(['bukus_id' => $id])->all();

        $newReview = new ReviewBuku(); // Inisialisasi objek untuk ulasan baru
        $userId = Yii::$app->user->isGuest ? null : Yii::$app->user->id;

        if ($newReview->load(Yii::$app->request->post())) {
            // Setel ID pengguna yang sudah login ke atribut anggota_id pada model ReviewBuku
            $newReview->anggota_id = $userId;
            $newReview->bukus_id = $id; // Atur ID buku

            if ($newReview->save()) {
                Yii::$app->session->setFlash('success', 'Review berhasil disimpan.');
                return $this->refresh(); // Refresh halaman setelah penyimpanan berhasil
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan ulasan.');
                // Handle error saving data to database
            }
        }

        return $this->render('book31', [
            'bukus' => $bukus,
            'reviews' => $reviews,
            'newReview' => $newReview,
            'userId' => $userId
        ]);

    }

    public function actionPeminjaman()
    {
        $bukus = Bukus::find()->all();

        $model = new Peminjamen();
        $model->status = 'pending';
        $userId = Yii::$app->user->isGuest ? null : Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post())) {
            // Setel ID pengguna yang sudah login ke atribut anggota_id pada model ReviewBuku
            $model->anggota_id = $userId;
            // Atur ID buku

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Harap Untuk Menunggu di Accept.');
                return $this->redirect(['site/riwayat']); // Refresh halaman setelah penyimpanan berhasil
            } else {
                Yii::$app->session->setFlash('error', 'Gagal.');
                // Handle error saving data to database
            }
        }

        return $this->render('peminjaman', [
            'model' => $model,
            'bukus' => $bukus,
            'userId' => $userId,
        ]);
    }

    public function actionRiwayat()
    {
        $userId = Yii::$app->user->identity->id; // ID pengguna yang sedang login
        $riwayat = Peminjamen::find()->where(['anggota_id' => $userId])->all();

        return $this->render('riwayat', [
            'riwayat' => $riwayat,
        ]);
    }

    public function actionAdminLogin()
    {
        $model = new AdminLoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // Login sukses, redirect ke halaman admin
            return $this->redirect(['/site/dashboard']);
        }

        return $this->render('admin-login', [
            'model' => $model,
        ]);
    }

    public function actionDashboard()
    {
        // ... Logika bisnis untuk halaman dashboard

        return $this->render('dashboard');
    }

    public function actionApproval()
    {
        $peminjamans = new Peminjamen;
        $peminjamans->status = 'Diterima';
        $peminjamans = Peminjamen::find()->all();

        return $this->render('approval', [
            'peminjamans' => $peminjamans,
        ]);
    }

    public function actionAccept($id)
    {
        $peminjaman = Peminjamen::findOne($id);
        if ($peminjaman) {
            $peminjaman->status = 'Completed';
            $peminjaman->save();
            // Redirect atau lakukan hal lainnya setelah peminjaman diterima

            return $this->redirect(['site/riwayat']);
        }
    }

    public function actionReject($id)
    {
        $peminjaman = Peminjamen::findOne($id);
        if ($peminjaman) {
            $peminjaman->status = Peminjamen::STATUS_REJECTED;
            $peminjaman->save();
            // Redirect atau lakukan hal lainnya setelah peminjaman ditolak
        }
    }

}
