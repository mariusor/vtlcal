<?php
namespace tlcal\domain\models\ical;

use Eluceo\iCal\Component\Calendar as iCalCalendar;
use Eluceo\iCal\Component\Event;
use Eluceo\iCal\Component\Timezone;
use tlcal\domain\LiquidAssets;
use vsc\domain\models\ModelA;

class Calendar extends ModelA
{
    /**
     * @var iCalCalendar
     */
    protected $ical;

    public function __construct($type) {
        $this->ical = new iCalCalendar('TL-CAL/v0.0.1');
        $this->ical->setTimezone(new Timezone('UTC'));
        $this->ical->setPublishedTTL('P1H');
        $this->ical->setName('TL - ' . LiquidAssets::getLabel($type));
        $this->ical->setDescription('The Team Liquid Calendar translated to proper ICal format');
    }

    /**
     * @param Event $event
     */
    public function addEvent($event) {
        $this->ical->addComponent($event);
    }

    public function build() {
        return $this->ical->build();
    }
}
