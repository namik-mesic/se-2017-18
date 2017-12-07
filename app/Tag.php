<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Tag
 * @package App
 */
class Tag extends Model
{
    /**
     * @return BelongsToMany
     */
    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_tag', 'tag_id', 'offer_id');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
