<?php
/**
 * Created by PhpStorm.
 * User: Zerina
 * Date: 08.01.2018.
 * Time: 13:16
 */

namespace App;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model implements StaplerableInterface
{

    use EloquentTrait;

    /**
     * We can add our attachments to the fillable array so that they're
     * mass assignable on the model.
     *
     * @var array
     */
    protected $fillable = ['avatar'];

    /**
     * Inside our model's constructor, we'll define some stapler attachments:
     *
     * @param attributes
     */
    public function __construct(array $attributes = array())
    {
        // Define an attachment named 'foo', with both thumbnail (100x100) and large (300x300) styles,
        // using custom url and default_url configurations:
        $this->hasAttachedFile('avatar', [
            'styles' => [
                'thumbnail' => '100x100',
                'large' => '300x300'
            ],
            'url' => '/system/:attachment/:id_partition/:style/:filename',
            'default_url' => '/:attachment/:style/missing.jpg'
        ]);

        // IMPORTANT:  the call to the parent constructor method
        // should always come after we define our attachments.
        parent::__construct($attributes);
    }
}