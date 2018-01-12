<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use League\Fractal\Resource\Collection as FractalCollection;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;

/**
 * Class BaseController
 * @package App\Http\Controllers\API
 */
class BaseController extends Controller
{
    /**
     * @var Manager
     */
    protected $manager;

    /**
     * @param Collection $collection
     * @param TransformerAbstract $transformerAbstract
     * @return string
     */
    public function jsonCollection(Collection $collection, TransformerAbstract $transformerAbstract)
    {
        return $this->manager
            ->createData(new FractalCollection($collection, $transformerAbstract))
            ->toJson();
    }

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->manager = new Manager;
    }
}