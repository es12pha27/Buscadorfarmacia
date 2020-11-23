<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pharmacy Entity
 *
 * @property int $id
 * @property string $name
 * @property int $coordinate_id
 * @property string $address
 *
 * @property \App\Model\Entity\Coordinate $coordinate
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Product[] $products
 */
class Pharmacy extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'coordinate_id' => true,
        'address' => true,
        'coordinate' => true,
        'comments' => true,
        'products' => true,
    ];
}
