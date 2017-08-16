<?php

namespace app\models;

use Yii;
use yii\helpers\BaseFileHelper;

/**
 * This is the model class for table "tourPhotos".
 *
 * @property integer $id
 * @property integer $tourId
 * @property string $src
 * @property integer $userId
 * @property integer $isPromo
 *
 * @property Profile $user
 * @property Tour $tour
 */
class TourPhotos extends \yii\db\ActiveRecord
{
    /**
     * The attribute for the file input for upload on the form
     */
    public $images;
    public $promoImage;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tourPhotos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['tourId', 'userId'], 'required'],
            [['tourId', 'userId', 'isPromo'], 'integer'],
            [['src', 'promoImage'], 'string'],
            [['images'], 'file', 'extensions' => 'jpg, gif, png', 'maxFiles' => 10],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['userId' => 'user_id']],
            [['tourId'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::className(), 'targetAttribute' => ['tourId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'images' => 'The maximum size of a single file is 3 MB. Supported file formats: JPG, PNG, GIF, BMP.',
            'promoImage' => 'Upload photo cover',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tourId']);
    }

    /**
     * fetch stored image file name with complete path
     * @return string
     */
    public function getImageFile($dirId)
    {
        $pathToPhotos = Yii::$app->basePath . '/web/uploads/photos/' . $dirId;
        if (!is_dir($pathToPhotos)) {
            BaseFileHelper::createDirectory(Yii::$app->basePath . '/web/uploads/photos/' . $dirId);
        }
        return isset($this->src) ? $pathToPhotos . '/' . $this->src : null;
    }

    /**
     * Process upload of image
     */
    public function uploadImage($image)
    {
        if (empty($image)) {
            return false;
        }
        $extension = end(explode(".", $image->name));
        $this->src = Yii::$app->security->generateRandomString().".{$extension}";

        $imageResource = imagecreatefromjpeg($image->tempName);
        $imageResource = imagerotate($imageResource, array_values([0, 0, 0, 180, 0, 0, -90, 0, 90])[@exif_read_data($image->tempName)['Orientation'] ?: 0], 0);

        return $imageResource;
    }

    /**
     * Process upload of promo image
     */
    public function uploadPromoImage($data)
    {
        if (empty($data)) {
            return false;
        }

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $promoImage = base64_decode($data);
        $this->src = Yii::$app->security->generateRandomString().'.jpg';
        $this->isPromo = 1;

        return $promoImage;
    }
}
