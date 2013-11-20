<?php if(!defined('IS_CMS')) die();

/***************************************************************
*
* Plugin fuer moziloCMS, welches die Einbindung von swf Dateien ermoeglicht
* by black-night - Daniel Neef
* 
***************************************************************/

class Flash extends Plugin {
    

    /***************************************************************
    * 
    * Gibt den HTML-Code zurueck, mit dem die Plugin-Variable ersetzt 
    * wird.
    * 
    ***************************************************************/	
	
	private $lang_admin;
	private $lang_cms;
	
    function getContent($value) {               
		global $specialchars;
		global $CatPage;
		
		$values = explode(",", $value);
		if (count($values) <> 3) return null;		
		
		list($cat,$datei) = $CatPage->split_CatPage_fromSyntax($values[2],true);
		
		$file = CONTENT_DIR_NAME."/".$cat."/".CONTENT_FILES_DIR_NAME."/".$datei;
		
		$result  = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="'.$values[0].'" height="'.$values[1].'" align="middle">';
        $result .= '  <param name="movie" value="'.$file.'"/>';
        $result .= '  <!--[if !IE]>-->';
        $result .= '  <object type="application/x-shockwave-flash" data="'.$file.'" width="'.$values[0].'" height="'.$values[1].'">';
        $result .= '    <param name="movie" value="'.$file.'"/>';
        $result .= '  <!--<![endif]-->';
        $result .= '  <a href="http://www.adobe.com/go/getflash">';
        $result .= '    <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"/>';
        $result .= '  </a>';
        $result .= '  <!--[if !IE]>-->';
        $result .= '  </object>';
        $result .= '  <!--<![endif]-->';
        $result .= '</object>';	
        
        return $result;

    } // function getContent
    
    
    
    /***************************************************************
    * 
    * Gibt die Konfigurationsoptionen als Array zurueck.
    * 
    ***************************************************************/
    function getConfig() {

        $config = array();    
        return $config;            
    } // function getConfig
    
    
    
    /***************************************************************
    * 
    * Gibt die Plugin-Infos als Array zurueck. 
    * 
    ***************************************************************/
    function getInfo() {
        global $ADMIN_CONF;
        $dir = $this->PLUGIN_SELF_DIR;
        $language = $ADMIN_CONF->get("language");
        $this->lang_admin = new Language($dir."sprachen/admin_language_".$language.".txt");        
        $info = array(
            // Plugin-Name
            "<b>".$this->lang_admin->getLanguageValue("config_plugin_name")."</b> \$Revision: 1 $",
            // CMS-Version
            "2.0",
            // Kurzbeschreibung
            $this->lang_admin->getLanguageValue("config_plugin_desc"),
            // Name des Autors
           "black-night",
            // Download-URL
            array("http://software.black-night.org","Software by black-night"),
            # Platzhalter => Kurzbeschreibung
            array('{Flash|500,300,...}' => $this->lang_admin->getLanguageValue("config_plugin_name")
                 )
            );
            return $info;        
    } // function getInfo
    
    /***************************************************************
    *
    * Interne Funktionen
    *
    ***************************************************************/
    
    private function getInteger($value) {
    	if (is_numeric($value) and ($value > 0)) {
    		return $value;
    	} else {
    		return 1;    	
    	}
    } //function getInteger
           
    
} // class Flash

?>