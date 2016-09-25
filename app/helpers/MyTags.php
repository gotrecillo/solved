<?php
namespace Solved\Helpers;

use Phalcon\Tag;

class MyTags extends Tag
{
  /**
   * Creates ann input field with an icon
   *
   * @param mixed[] $parameters Array with a key element and icon to create the input
   * @return string
   */
  public function iconField($parameters){
    $form = $parameters['form'];
    $icon = $parameters['icon'];
    $element = $form->render($parameters['element']);

    $code = <<<EOD
      <div class="field">
    		<div class="ui left icon input">
    			<i class="$icon icon"></i>
    		$element
    		</div>
    	</div>
EOD;

    return $code;
  }

  /**
   * Creates an checkbox input field
   *
   * @param mixed[] $parameters Array with a key element and icon to create the input
   * @return string
   */
  public function checkbox($parameters){
    $form = $parameters['form'];
    $element = $form->render($parameters['element']);
    $label = $form->label($parameters['element']);

    $code = <<<EOD
      <div class="ui checkbox">
        $element
        $label
      </div>
EOD;

    return $code;
  }


}
