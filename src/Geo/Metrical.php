<?php

namespace Bavix\Geo;

use Bavix\Geo\Figures\RectangleFigure;

class Metrical
{

    /**
     * @var string|Unit
     */
    protected $unit;

    /**
     * Distance constructor.
     * @param string $unit
     */
    public function __construct(string $unit = Units\MileUnit::class)
    {
        $this->unit = $unit;
    }

    /**
     * @param Coordinate $first
     * @param Coordinate $second
     *
     * @return Unit
     *
     * @see https://en.wikipedia.org/wiki/Great-circle_distance
     */
    public function distance(Coordinate $first, Coordinate $second): Unit
    {
        $theta = $first->getLongitudeDeg() - $second->getLongitudeDeg();
        $partSin = \sin($first->getLatitudeRad()) * \sin($second->getLatitudeRad());
        $partCos = \cos($first->getLatitudeRad()) * \cos($second->getLatitudeRad()) * \cos(\deg2rad($theta));
        $dist = \rad2deg(\acos($partSin + $partCos));
        $miles = $dist * 60. * 1.1515;

        return $this->unit::fromMiles($miles);
    }

    /**
     * @param Coordinate $center
     * @param Unit $unit
     * @return RectangleFigure
     */
    public function square(Coordinate $center, Unit $unit): RectangleFigure
    {
        $dd = $this->_dd($unit);
        $dx = $this->_dx($dd);
        $dy = $this->_dy($dd);

        return RectangleFigure::make($center, $dx, $dy);
    }

    /**
     * @param Coordinate $center
     * @param Unit $axisX
     * @param Unit $axisY
     * @return RectangleFigure
     */
    public function rectangle(Coordinate $center, Unit $axisX, Unit $axisY): RectangleFigure
    {
        $ddX = $this->_dd($axisX);
        $dx = $this->_dx($ddX);

        $ddY = $this->_dd($axisY);
        $dy = $this->_dx($ddY);

        return RectangleFigure::make($center, $dx, $dy);
    }

    /**
     * @param float $dd
     * @return float
     */
    protected function _dx(float $dd): float
    {
        return \deg2rad(hypot($dd, $dd) / 2.);
    }

    /**
     * @param float $dd
     * @return float
     */
    protected function _dy(float $dd): float
    {
        return \deg2rad(hypot(0, $dd * 2.) / 2.);
    }

    /**
     * @param Unit $unit
     * @return float
     */
    protected function _dd(Unit $unit): float
    {
        $distance = $unit->miles() / 60. / 1.1515;
        return \rad2deg($distance);
    }

}