<?php
/**
 * Created by PhpStorm.
 * User: Magnus
 * Date: 11-Oct-17
 * Time: 23:58
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

/**
 * Class Offer
 * @package App
 */
class Offer extends model
{

    /**
     * @var
     */
    protected $fillable = [
        'meal',
        'ingredients',
        'cost',
        'category',
        'counter'
    ];

    /**
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'offer_tag', 'offer_id', 'tag_id');
    }

}