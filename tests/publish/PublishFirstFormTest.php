<?php
/**
 * This file is part of OPUS. The software OPUS has been originally developed
 * at the University of Stuttgart with funding from the German Research Net,
 * the Federal Department of Higher Education and Research and the Ministry
 * of Science, Research and the Arts of the State of Baden-Wuerttemberg.
 *
 * OPUS 4 is a complete rewrite of the original OPUS software and was developed
 * by the Stuttgart University Library, the Library Service Center
 * Baden-Wuerttemberg, the Cooperative Library Network Berlin-Brandenburg,
 * the Saarland University and State Library, the Saxon State Library -
 * Dresden State and University Library, the Bielefeld University Library and
 * the University Library of Hamburg University of Technology with funding from
 * the German Research Foundation and the European Regional Development Fund.
 *
 * LICENCE
 * OPUS is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the Licence, or any later version.
 * OPUS is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details. You should have received a copy of the GNU General Public License
 * along with OPUS; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 *
 * @category    Application
 * @package     Selenium Test
 * @author      Sascha Szott <szott@zib.de>
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

class PublishFirstFormTest extends TestCase {

    /**
     * Regression Test for OPUSVIER-2676
     */
    public function testMissingRightsInFirstFormStep() {
        $this->switchToGerman();

        $this->open("/publish");
        $this->waitForPageToLoad();

        $this->select("documentType", "value=all");
        $this->click("send");
        $this->waitForPageToLoad();

        $this->assertTrue($this->isTextPresent("Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern."));
        $this->assertTrue($this->isTextPresent("Fehler: Bestätigen Sie bitte unsere rechtlichen Hinweise."));
        $this->assertTrue($this->isTextPresent("Dokumenttyp und Datei wählen"));

        $this->click('rights');
        $this->click("send");
        $this->waitForPageToLoad();
        
        $this->assertTrue($this->isTextPresent("Kontaktdaten des Einstellers"));
        $this->assertFalse($this->isTextPresent("Dokumenttyp und Datei wählen"));
    }

    /**
     * Regression Test for OPUSVIER-2676
     */
    public function testMissingDoctypeInFirstFormStep() {
        $this->switchToGerman();

        $this->open("/publish");
        $this->waitForPageToLoad();

        $this->click('rights');
        $this->click("send");
        $this->waitForPageToLoad();

        $this->assertTrue($this->isTextPresent("Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern."));
        $this->assertTrue($this->isTextPresent("Fehler: Dokumenttyp fehlt!"));
        $this->assertTrue($this->isTextPresent("Dokumenttyp und Datei wählen"));

        $this->select("documentType", "value=all");
        $this->click("send");
        $this->waitForPageToLoad();

        $this->assertTrue($this->isTextPresent("Kontaktdaten des Einstellers"));
        $this->assertFalse($this->isTextPresent("Dokumenttyp und Datei wählen"));
    }

    /**
     * Regression Test for OPUSVIER-2676
     */
    public function testMissingRightsAndDoctypeInFirstFormStep() {
        $this->switchToGerman();

        $this->open("/publish");
        $this->waitForPageToLoad();
        
        $this->click("send");
        $this->waitForPageToLoad();

        $this->assertTrue($this->isTextPresent("Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern."));
        $this->assertTrue($this->isTextPresent("Fehler: Dokumenttyp fehlt!"));
        $this->assertTrue($this->isTextPresent("Fehler: Bestätigen Sie bitte unsere rechtlichen Hinweise."));
        $this->assertTrue($this->isTextPresent("Dokumenttyp und Datei wählen"));

        $this->select("documentType", "value=all");
        $this->click('rights');
        $this->click("send");
        $this->waitForPageToLoad();

        $this->assertTrue($this->isTextPresent("Kontaktdaten des Einstellers"));
        $this->assertFalse($this->isTextPresent("Dokumenttyp und Datei wählen"));
    }

}
