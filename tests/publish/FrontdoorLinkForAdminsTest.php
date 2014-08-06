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
 * @package     Module_Publish
 * @author      Jens Schwidder <schwidder@zib.de>
 * @copyright   Copyright (c) 2008-2014, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

/**
 * Class FrontdoorLinkForAdminsTest.
 * TODO Nach Umbau von Publish, Entscheidung über Anzeige von Link in Unit Tests prüfen.
 */
class FrontdoorLinkForAdminsTest extends TestCase {

    public function testFrontdoorLinkForAdmin() {
        $this->switchToGerman();
        $this->login();

        $this->openAndWait("/publish");

        // Page one of Publish
        $this->select('documentType', 'value=all');
        $this->click('rights');

        $this->clickAndWait('send');

        // Page two of Publish
        $this->click('LegalNotices');

        $this->clickAndWait('send');

        // Confirmation page of Publish
        $this->clickAndWait('send');

        // Check link
        $this->assertElementPresent('frontdoor-link');
   }

    public function testFrontdoorLinkForDocumentsAdmin() {
        $this->switchToGerman();
        $this->login('security8', 'security8pwd');

        $this->openAndWait("/publish");

        // Page one of Publish
        $this->select('documentType', 'value=all');
        $this->click('rights');

        $this->clickAndWait('send');

        // Page two of Publish
        $this->click('LegalNotices');

        $this->clickAndWait('send');

        // Confirmation page of Publish
        $this->clickAndWait('send');

        // Check link
        $this->assertElementPresent('frontdoor-link');
    }

    public function testFrontdoorLinkForGuest() {
        $this->switchToGerman();

        $this->openAndWait("/publish");

        // Page one of Publish
        $this->select('documentType', 'value=all');
        $this->click('rights');

        $this->clickAndWait('send');

        // Page two of Publish
        $this->click('LegalNotices');

        $this->clickAndWait('send');

        // Confirmation page of Publish
        $this->clickAndWait('send');

        // Check link
        $this->assertElementNotPresent('frontdoor-link');
    }

    public function testFrontdoorLinkForFullAdmin() {
        $this->switchToGerman();
        $this->login('security1', 'security1pwd');

        $this->openAndWait("/publish");

        // Page one of Publish
        $this->select('documentType', 'value=all');
        $this->click('rights');

        $this->clickAndWait('send');

        // Page two of Publish
        $this->click('LegalNotices');

        $this->clickAndWait('send');

        // Confirmation page of Publish
        $this->clickAndWait('send');

        // Check link
        $this->assertElementPresent('frontdoor-link');
    }

    public function testFrontdoorLinkForLicenceAdmin() {
        $this->switchToGerman();
        $this->login('security2', 'security2pwd');

        $this->openAndWait("/publish");

        // Page one of Publish
        $this->select('documentType', 'value=all');
        $this->click('rights');

        $this->clickAndWait('send');

        // Page two of Publish
        $this->click('LegalNotices');

        $this->clickAndWait('send');

        // Confirmation page of Publish
        $this->clickAndWait('send');

        // Check link
        $this->assertElementNotPresent('frontdoor-link');
    }

}