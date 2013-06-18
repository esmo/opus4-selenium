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
 * @category    Selenium Tests 
 * @package     Authorisation
 * @author      Jens Schwidder <schwidder@zib.de>
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'authorisation/TestCaseAuthorisation.php';

/**
 * 
 */
class CollectionsAdminTest extends TestCaseAuthorisation {
    
    /**
     * Prüft, ob nur die erlaubten Einträge im Admin Menu angezeigt werden.
     */
    public function testAdminMenuFiltering() {
        $this->switchToEnglish();
        $this->login("security9", "security9pwd");
        $this->openAndWait('/admin');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/licence")]');
        $this->assertElementPresent('//a[contains(@href, "/admin/oailink")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/documents")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/account")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/security")]');
        $this->assertElementPresent('//a[contains(@href, "/admin/collectionroles")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/series")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/language")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/statistic")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/dnbinstitute")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/enrichmentkey")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/info")]');
        $this->assertElementNotPresent('//a[contains(@href, "/review")]');
    }
    
    public function testAccessCollectionControllerShowAction() {
        $this->switchToEnglish();
        $this->login("security9", "security9pwd");
        $this->openAndWait('/admin/collection/show/id/4');
        $this->assertElementContainsText('//html/head/title', 'List Collection Entries');
        $this->assertElementContainsText('//html/body', 'Manage Collections');
    }
    
    public function testNoAccessCollectionControllerAssignAction() {
        $this->switchToEnglish();
        $this->login("security9", "security9pwd");
        $this->openAndWait('/admin/collection/assign/document/92');
        $this->assertElementContainsText('//html/head/title', 'Login');
    }
    
}