<?php

/**  
 * adapted from http://github.com/ornicar/diem-project  
 */  
class myHighlightMarkdown extends dmMarkdown  
{  
    public function __construct( dmHelper $helper, array $options = array() )  
    {  
        parent::__construct($helper, $options);  
    }  
 
    protected function preTransform($text)  
    {  
        $text = parent::preTransform($text);  
 
        if (strpos($text, '[/code]'))  
        {  
            $text = preg_replace_callback(  
                    '#\[code\s?(\w*)\]((?:\n|.)*)\n\[/code\]#uU',  
                    array($this, 'formatCode'),  
                    $text  
            );  
        }  
 
        return $text;  
    }  
 
    protected function formatCode(array $matches)  
    {  
        $language = $matches[1];  
 
        // no language specified  
        if (!$matches[1])  
        {  
            $html = '<pre><code>'.htmlentities($matches[2]).'</code></pre>';  
 
            $html = dmString::str_replace_once("\n", '', $html);  
 
            $html = dmString::str_replace_once('  ', '', $html);  
 
            return $html;  
        }  
        else  
        {  
            $html = '<pre><code class="'.$language.'">'.htmlentities($matches[2]).'</code></pre>';
            
            $html = dmString::str_replace_once("\n", '', $html);  
 
            $html = dmString::str_replace_once('  ', '', $html);  
 
            return $html;
        }  
    }  
}