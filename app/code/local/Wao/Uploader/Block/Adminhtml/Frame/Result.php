<?php

class Wao_Uploader_Block_Adminhtml_Frame_Result extends Mage_Adminhtml_Block_Template
{
    protected $_actions = array(
        'clear'           => array(), // remove element from DOM
        'innerHTML'       => array(), // set innerHTML property (use: elementID => new content)
        'value'           => array(), // set value for form element (use: elementID => new value)
        'show'            => array(), // show specified element
        'hide'            => array(), // hide specified element
        'removeClassName' => array(), // remove specified class name from element
        'addClassName'    => array()  // add specified class name to element
    );

    protected $_messages = array(
        'error'   => array(),
        'success' => array(),
        'notice'  => array()
    );

    public function addAction($actionName, $elementId, $value = null)
    {
        if (isset($this->_actions[$actionName])) {
            if (null === $value) {
                if (is_array($elementId)) {
                    foreach ($elementId as $oneId) {
                        $this->_actions[$actionName][] = $oneId;
                    }
                } else {
                    $this->_actions[$actionName][] = $elementId;
                }
            } else {
                $this->_actions[$actionName][$elementId] = $value;
            }
        }
        return $this;
    }

    public function addError($message)
    {
        if (is_array($message)) {
            foreach ($message as $row) {
                $this->addError($row);
            }
        } else {
            $this->_messages['error'][] = $message;
        }
        return $this;
    }

    public function addNotice($message, $appendImportButton = false)
    {
        if (is_array($message)) {
            foreach ($message as $row) {
                $this->addNotice($row);
            }
        } else {
            $this->_messages['notice'][] = $message . ($appendImportButton ? $this->getImportButtonHtml() : '');
        }
        return $this;
    }

    public function addSuccess($message, $appendImportButton = false)
    {
        if (is_array($message)) {
            foreach ($message as $row) {
                $this->addSuccess($row);
            }
        } else {
            $this->_messages['success'][] = $message . ($appendImportButton ? $this->getImportButtonHtml() : '');
        }
        return $this;
    }

    public function getImportButtonHtml()
    {
        return '&nbsp;&nbsp;<button onclick="editForm.startImport(\'' . $this->getImportStartUrl()
            . '\', \'' . Mage_ImportExport_Model_Import::FIELD_NAME_SOURCE_FILE . '\');" class="scalable save"'
            . ' type="button"><span><span><span>' . $this->__('Import') . '</span></span></span></button>';
    }

    public function getImportStartUrl()
    {
        return $this->getUrl('*/*/start');
    }

    public function getMessages()
    {
        return $this->_messages;
    }

    public function getMessagesHtml()
    {
        /** @var $messagesBlock Mage_Core_Block_Messages */
        $messagesBlock = $this->_layout->createBlock('core/messages');

        foreach ($this->_messages as $priority => $messages) {
            $method = "add{$priority}";

            foreach ($messages as $message) {
                $messagesBlock->$method($message);
            }
        }
        return $messagesBlock->toHtml();
    }

    public function getResponseJson()
    {
        // add messages HTML if it is not already specified
        if (!isset($this->_actions['import_validation_messages'])) {
            $this->addAction('innerHTML', 'import_validation_messages', $this->getMessagesHtml());
        }
        return Mage::helper('core')->jsonEncode($this->_actions);
    }
}
