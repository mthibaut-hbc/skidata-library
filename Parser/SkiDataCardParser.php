<?php

/**
 * This file is part of the skidata-library package.
 *
 * (c) 2017 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\SkiData\Parser;

use WBW\Library\Core\Argument\BooleanHelper;
use WBW\Library\SkiData\Entity\SkiDataCard;

/**
 * SkiData card parser.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\SkiData\Parser
 */
class SkiDataCardParser extends AbstractSkiDataParser {

    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Parse a card entity.
     *
     * @param SkiDataCard $entity The card entity.
     * @return string Returns the parsed card entity.
     */
    public function parseEntity(SkiDataCard $entity) {

        // Initialise the output.
        $output = [];

        $output[] = $this->encodeString($entity->getTicketNumber(), 23);
        $output[] = $this->encodeInteger($entity->getUserNumber(), 9);
        $output[] = $this->encodeInteger($entity->getArticleNumber(), 3);
        $output[] = $this->encodeDate($entity->getValidFrom());
        $output[] = $this->encodeDate($entity->getExpires());
        $output[] = $this->encodeBoolean($entity->getBlocked());
        $output[] = $this->encodeDate($entity->getBlockedDate());
        $output[] = $this->encodeInteger($entity->getProductionState(), 1);
        $output[] = $this->encodeInteger($entity->getReasonProduction(), 1);
        $output[] = $this->encodeInteger($entity->getProductionCounter(), 4);
        $output[] = $this->encodeBoolean($entity->getNeutral());
        $output[] = $this->encodeBoolean($entity->getRetainTicketEntry());
        $output[] = $this->encodeBoolean($entity->getEntryBarrierClosed());
        $output[] = $this->encodeBoolean($entity->getExitBarrierClosed());
        $output[] = $this->encodeBoolean($entity->getRetainTicketExit());
        $output[] = $this->encodeBoolean($entity->getDisplayText());
        $output[] = $this->encodeString($entity->getDisplayText1(), 16);
        $output[] = $this->encodeString($entity->getDisplayText2(), 16);
        $output[] = $this->encodeInteger($entity->getPersonnalNo(), 4);
        $output[] = $this->encodeInteger($entity->getResidualValue(), 12);
        $output[] = $this->encodeString($entity->getSerialNumberKeyCardSwatch(), 20);
        $output[] = $this->encodeString($entity->getCurrencyResidualValue(), 3);
        $output[] = $this->encodeInteger($entity->getTicketType(), 1);
        $output[] = $this->encodeString($entity->getTicketSubType(), 5);
        $output[] = $this->encodeString($entity->getSerialNo(), 30);
        $output[] = $this->encodeDate($entity->getSuspendPeriodFrom());
        $output[] = $this->encodeDate($entity->getSuspendPeriodUntil());
        $output[] = $this->encodeBoolean($entity->getUseValidCarParks());
        $output[] = $this->encodeInteger($entity->getProductionFacilityNumber(), 7);

        // Return the output.
        return implode(";", $output);
    }

    /**
     * Parse a line.
     *
     * @param string $line The line.
     * @return SkiDataCard Returns a card entity.
     */
    public function parseLine($line) {

        // Split the line.
        $data = explode(";", $line);
        $i    = 0;

        // Initialize the entity.
        $entity = new SkiDataCard();

        $entity->setTicketNumber($this->decodeString($data[$i++]));
        $entity->setUserNumber($this->decodeInteger($data[$i++]));
        $entity->setArticleNumber($this->decodeInteger($data[$i++]));
        $entity->setValidFrom($this->decodeDate($data[$i++]));
        $entity->setExpires($this->decodeDate($data[$i++]));
        $entity->setBlocked(BooleanHelper::parseString($data[$i++]));
        $entity->setBlockedDate($this->decodeDate($data[$i++]));
        $entity->setProductionState($this->decodeInteger($data[$i++]));
        $entity->setReasonProduction($this->decodeInteger($data[$i++]));
        $entity->setProductionCounter($this->decodeInteger($data[$i++]));
        $entity->setNeutral(BooleanHelper::parseString($data[$i++]));
        $entity->setRetainTicketEntry(BooleanHelper::parseString($data[$i++]));
        $entity->setEntryBarrierClosed(BooleanHelper::parseString($data[$i++]));
        $entity->setExitBarrierClosed(BooleanHelper::parseString($data[$i++]));
        $entity->setRetainTicketExit(BooleanHelper::parseString($data[$i++]));
        $entity->setDisplayText(BooleanHelper::parseString($data[$i++]));
        $entity->setDisplayText1($this->decodeString($data[$i++]));
        $entity->setDisplayText2($this->decodeString($data[$i++]));
        $entity->setPersonnalNo($this->decodeInteger($data[$i++]));
        $entity->setResidualValue($this->decodeInteger($data[$i++]));
        $entity->setSerialNumberKeyCardSwatch($this->decodeString($data[$i++]));
        $entity->setCurrencyResidualValue($this->decodeString($data[$i++]));
        $entity->setTicketType($this->decodeInteger($data[$i++]));
        $entity->setTicketSubType($this->decodeString($data[$i++]));
        $entity->setSerialNo($this->decodeString($data[$i++]));
        $entity->setSuspendPeriodFrom($this->decodeDate($data[$i++]));
        $entity->setSuspendPeriodUntil($this->decodeDate($data[$i++]));
        $entity->setUseValidCarParks(BooleanHelper::parseString($data[$i++]));
        $entity->setProductionFacilityNumber($this->decodeInteger($data[$i++]));

        // Return the entity.
        return $entity;
    }

}
