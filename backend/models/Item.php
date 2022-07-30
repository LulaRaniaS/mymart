<?php

namespace backend\models;

use Yii;

use backend\models\ItemCategory;


/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property string|null $picture
 * @property int $category_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property OrderItem[] $orderItems
 * @property CustomerOrder[] $customerOrders
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'category_id'], 'required'],
            [['price', 'category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['picture'], 'file', 'skipOnEmpty'=>TRUE, 'extensions' => 'jpg, png']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'picture' => 'Picture',
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    // public function getOrderItems()
    // {
    //     return $this->hasMany(OrderItem::className(), ['item_id' => 'id']);
    // }

    /**
     * Gets query for [[CustomerOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
   
   public function getItemCategory()
   {
    return $this->hasOOne(ItemCategory::className(), ['id' => 'category_id']);
   }
}
