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
 * @category    TODO
 * @package     TODO
 * @author      Edouard Simon (edouard.simon@zib.de)
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'authorisation/TestCaseAuthorisation.php';

/**
 * 
 */
class AuthorisationTest extends TestCaseAuthorisation {
    
    public function testAuthoriseGuestForAdminDocuments() {
        $this->switchToEnglish();
        $this->openAndWait('/admin/documents');
        $this->assertElementContainsText('//html/head/title', 'Login');
        $this->toggleAccess(2, array('admin', 'resource_documents'));
        $this->openAndWait('/admin/documents');
        $this->assertElementContainsText('//html/head/title', 'Administration of Documents');
        $this->toggleAccess(2, array('admin', 'resource_documents'));
    }
    
    public function testGuestNoAccessAccountAdministration() {
        $this->switchToEnglish();
        $this->openAndWait('/admin/account');
        $this->assertElementContainsText('//html/head/title', 'Login');
    }

    public function testAllowUserNameLikeRoleName() {
        $this->switchToEnglish();
        $this->createUser('administrator', 'adminadmin');
        $this->login('administrator', 'adminadmin');
        $this->openAndWait('/admin/documents');
        $this->assertElementContainsText('//html/head/title', 'Login');
        $this->assertElementContainsText('//html/body', 'Logout administrator');
        $this->removeUser('administrator');
    }
    
    public function testNoAccessAdministration() {
        $this->switchToEnglish();
        $this->openAndWait('/admin');
        $this->assertElementContainsText('//html/head/title', 'Login');
    }

}
