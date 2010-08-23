<?php

	Class extension_Postmarkapp_Email_Library extends Extension{
		
		public function about(){
			return array('name' => 'Postmark App Email Library',
						 'version' => '1.0',
						 'release-date' => '2010-08-23',
						 'author' => array('name' => 'Alistair Kearney',
										   'website' => 'http://alistairkearney.com',
										   'email' => 'hi@alistairkearney.com')
				 		);
		}
		
		public function getSubscribedDelegates(){
			return array(
				array(
					'page' => '/system/preferences/',
					'delegate' => 'AddCustomPreferenceFieldsets',
					'callback' => 'cbAppendPreferences'
				),
			);
		}
				
		public function uninstall(){
			Symphony::Configuration()->remove('postmarkapp');
			$this->_Parent->saveConfig();
		}
			
		public function cbAppendPreferences($context){

			$group = new XMLElement('fieldset');
			$group->setAttribute('class', 'settings');
			$group->appendChild(new XMLElement('legend', __('Postmark App')));

			$label = Widget::Label(__('API Key'));
			$label->appendChild(Widget::Input('settings[postmarkapp][api_key]', Symphony::Configuration()->get('api_key', 'postmarkapp')));
			$group->appendChild($label);

			$div = new XMLElement('div');
			$div->setAttribute('class', 'group');
			$label = Widget::Label(__('From Name'));
			$label->appendChild(Widget::Input('settings[postmarkapp][from_name]', Symphony::Configuration()->get('from_name', 'postmarkapp')));
			$div->appendChild($label);
			
			$label = Widget::Label(__('From Email Address'));
			$label->appendChild(Widget::Input('settings[postmarkapp][from_address]', Symphony::Configuration()->get('from_address', 'postmarkapp')));
			$div->appendChild($label);
			$group->appendChild($div);
			
			$group->appendChild(new XMLElement('p', 'Must match a server signature address created in Postmark.', array('class' => 'help')));	
			
			$context['wrapper']->appendChild($group);

		}

	}

