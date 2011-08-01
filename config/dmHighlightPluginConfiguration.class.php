<?php

class dmHighlightPluginConfiguration extends sfPluginConfiguration
{
  public static $themes = array
        ('default', 'ascetic', 'brown_paper',
        'dark', 'far', 'github',
        'idea', 'ir_black', 'magula',
        'school_book', 'sunburst', 'vs',
        'zunburn');
  
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $this->dispatcher->connect('dm.context.loaded', array($this, 'listenToContextLoadedEvent'));
  }

  public function listenToContextLoadedEvent(sfEvent $e)
  {
    $e->getSubject()->getResponse()
    ->addJavascript(sfConfig::get('app_dmHighlightPlugin_js')
      ? sfConfig::get('app_dmHighlightPlugin_js')
      : 'dmHighlightPlugin.highlight')
    ->addJavascript('dmHighlightPlugin.enablehighlight');

    $theme = sfConfig::get('dm_dmHighlightPlugin_theme');
    if(!in_array($theme, self::$themes)) {
      $stylesheet = $theme;
    } else {
      $stylesheet = 'dmHighlightPlugin.'.$theme;
    }
    
    $e->getSubject()->getResponse()
    ->addStylesheet($stylesheet);
 }
}