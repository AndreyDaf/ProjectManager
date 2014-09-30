<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Captcha
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Captcha image model
 *
 * @category   Mage
 * @package    Mage_Captcha
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Wao_Project_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Get id user which logged in
     *
     * @return int
     */
    public function getCurrentUserId()
    {
        $userSession = Mage::getSingleton('admin/session');
        
        return $userSession->getUser()->getId();
    }
    
    /**
     * Get id role user which logged in
     *
     * @return int
     */
    public function getUserRoleId()
    {
        // Test
        $userSession = Mage::getSingleton('admin/session');
        
        return $userSession->getUser()->getRole()->getRoleId();
    }
    
    /**
     * Get name role user which logged in
     *
     * @return string
     */
    public function getUserRoleName()
    {
        $userSession = Mage::getSingleton('admin/session');
        
        return $userSession->getUser()->getRole()->getRoleName();
    }
}
