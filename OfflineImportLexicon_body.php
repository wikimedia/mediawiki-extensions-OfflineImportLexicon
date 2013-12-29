<?php

class OfflineImportLexicon extends SpecialPage {

  /**
   * Constructor
   */
  public function __construct() {
    SpecialPage::SpecialPage("OfflineImportLexicon");
    wfLoadExtensionMessages('OfflineImportLexicon');
  }


  /**
   * Execute
   * @param $par Subpage of the wiki page
   *
   */
  public function execute( $par ) {
	global $wgOut, $wgRequest, $wgUser;

	$this->setHeaders();
	$this->outputHeader();
    $selfTitle = $this->getTitle();
	$wgOut->setPagetitle( wfMsg('offlineimportlexicon') );
    $actionUrl = htmlspecialchars( $selfTitle->getLocalURL() );
	$arrFormats = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16");

	$wgOut->addHTML(wfMsg('initial_text'));

	$metadataType = $wgRequest->getVal( 'metadataType');
	$metadataTitle = $wgRequest->getVal( 'metadataTitle');
    $metadataShortTitle = $wgRequest->getVal( 'metadataShortTitle');
	$metadataSubtitle = $wgRequest->getVal( 'metadataSubtitle');
	$metadataPlaceofPublication = $wgRequest->getVal( 'metadataPlaceofPublication');
	$metadataEditor = $wgRequest->getVal( 'metadataEditor');
	$metadataPublisher = $wgRequest->getVal( 'metadataPublisher');
	$metadataLanguage = $wgRequest->getVal( 'metadataLanguage');
	$metadataYearofPublication = $wgRequest->getVal( 'metadataYearofPublication');
    $metadataVolumeCount = $wgRequest->getVal( 'metadataVolumeCount');
    $metadataHasVolume = $wgRequest->getVal( 'metadataHasVolume');
    $metadataEdition =  $wgRequest->getVal( 'metadataEdition');
    $volumeTitle = $wgRequest->getVal( 'volumeTitle');
	$volumeSubtitle = $wgRequest->getVal( 'volumeSubtitle');
	$volumePlaceofPublication = $wgRequest->getVal( 'volumePlaceofPublication');
	$volumeEditor = $wgRequest->getVal( 'volumeEditor');
	$volumePublisher = $wgRequest->getVal( 'volumePublisher');
	$volumeLanguage = $wgRequest->getVal( 'volumeLanguage');
	$volumeYearofPublication = $wgRequest->getVal( 'volumeYearofPublication');
    $volumeDescription = $wgRequest->getVal( 'volumeDescription');
    $volumeNumber = $wgRequest->getVal( 'volumeNumber');
	$lemmataTitle = $wgRequest->getVal( 'lemmataTitle');
	$lemmataSubtitle = $wgRequest->getVal( 'lemmataSubtitle');
    $lemmataAuthor = $wgRequest->getVal( 'lemmataAuthor');
	$lemmataLanguage = $wgRequest->getVal( 'lemmataLanguage');
    $lemmataFirstPage = $wgRequest->getVal( 'lemmataFirstPage');
	$lemmataLastPage = $wgRequest->getVal( 'lemmataLastPage');
    $lemmataFirstPageN = $wgRequest->getVal( 'lemmataFirstPageN');
	$lemmataLastPageN = $wgRequest->getVal( 'lemmataLastPageN');
    $lemmataImages = $wgRequest->getVal( 'lemmataImages');
    $lemmataRights = $wgRequest->getVal( 'lemmataRights');

    $output =  $wgRequest->getVal( 'output');
    $addVolume =  $wgRequest->getVal( 'addVolume');
    $addLemmata =  $wgRequest->getVal( 'addLemmata');
    $addDigitized = $wgRequest->getVal( 'addDigitized');

	$selectcompare = $wgRequest->getVal( 'selectcompare' );
	$selectoutput = $wgRequest->getVal( 'selectoutput' );
    if (!($wgUser->isLoggedIn() ) ){
			$wgOut->addWikiText("User must be logged in.") ;
            return false;
    }
    else
    {
	$formfields =  "<div class = 'import-init' id='import-init'>
    <div class = 'header' id='lexicon'>
    <fieldset id='field0'><legend>".wfMsg('lexicon')."</legend>
	<label>".wfMsg('lexicons').": </label>
	<select  id='selectLexicon'  size='1' />";
    $formfields .= "<option value=''>Select lexicon...</option>";
	$formfields .= "</select><br/><br/><button id='addLexicon'>".wfMsg('new_lexicon')."</button> </fieldset></div>
	<div class = 'header' id='volume'>
    <fieldset id='field00'><legend>".wfMsg('volume')."</legend>
	<label>".wfMsg('volumes').": </label>
	<select  id='selectVolume'  size='1' />";
	$formfields .= "</select><br/><br/><button id='addVolume'>".wfMsg('new_volume')."</button> </fieldset></div>
	<div  class='rightArea'><ul id='lexiconList'></ul><button id='addlemmatabutton'>".wfMsg('new_lemma')."</button><button id='addimagesbutton'>Add media metadata</button></div>
	</div>
	<div class='import-new' id='import-new'>
	<div id='lexicon_template'>
    <fieldset id='field1'><legend>".wfMsg('new_lexicon')."</legend>
	<form id='Lexicon' >
	<div class = 'lexiconInForm' >
	<table  id='lexicon_table' >
	<tr>
        <div class='tooltip-content' id='cora-content-1'>".wfMsg('content_1')."</div>
		<td class='tooltip-target' id='cora-target-1'>".wfMsg('title')."<em>*</em>:&nbsp;</td><td><input tabindex='1' type='text' id='metadataTitle' name = 'metadataTitle'  value='".$metadataTitle."'  maxlength='200' size='50' /> <td ><label class='error' for='metadataTitle' id='title_error'>This field is required.</label> </td>
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-2'>".wfMsg('content_2')."</div>
		<td class='tooltip-target' id='cora-target-2'>".wfMsg('short')."<em>*</em>:&nbsp;</td><td><input tabindex='1' type='text' id='metadataShortTitle' name='metadataShortTitle' value='".$metadataShortTitle."' maxlength='200' size='50' /> <td ><label class='error' for='metadataShortTitle' id='shortTitle_error'>This field is required.</label> </td>
		</td>
	</tr>

	<tr>
	    <div class='tooltip-content' id='cora-content-3'>".wfMsg('content_3')."</div>
		<td class='tooltip-target' id='cora-target-3'>".wfMsg('subtitle').":&nbsp;</td><td><input tabindex='1' type='text' id='metadataSubtitle' name='metadataSubtitle' value='".$metadataSubtitle."' maxlength='200' size='50' />  <td >&nbsp;</td>
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-4'>".wfMsg('content_4')."</div>
		<td class='tooltip-target' id='cora-target-4'>".wfMsg('place_of_publication')."<em>*</em>:&nbsp;</td><td><input tabindex='1' type='text' id='metadataPlaceofPublication' name='metadataPlaceofPublication' value='".$metadataPlaceofPublication."' maxlength='200' size='50' /> <td ><label class='error' for='metadataPlaceofPublication' id='place_error'>This field is required.</label> </td>
		</td>
	</tr>

	<tr>
	    <div class='tooltip-content' id='cora-content-5'>".wfMsg('content_5')."</div>
		<td class='tooltip-target' id='cora-target-5'>".wfMsg('year_of_publication')."<em>*</em>:&nbsp;</td><td><input tabindex='1' type='text' id='metadataYearofPublication' name='metadataYearofPublication' value='".$metadataYearofPublication."' maxlength='200' size='50' /><td ><label class='error' for='metadataYearofPublication' id='year_error'>This field is required.</label> </td>
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-6'>".wfMsg('content_6')."</div>
		<td class='tooltip-target' id='cora-target-6'>".wfMsg('editor')."<em>*</em>:&nbsp;</td><td><input tabindex='1' type='text' id='metadataEditor' name='metadataEditor' value='".$metadataEditor."' maxlength='200' size='50' /><td ><label class='error' for='metadataEditor' id='editor_error'>This field is required.</label> </td>
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-7'>".wfMsg('content_7')."</div>
		<td class='tooltip-target' id='cora-target-7'>".wfMsg('publisher').":&nbsp;</td><td><input tabindex='1' type='text' id='metadataPublisher' name='metadataPublisher' value='".$metadataPublisher."' maxlength='200' size='50' />
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-8'>".wfMsg('content_8')."</div>
		<td class='tooltip-target' id='cora-target-8'>".wfMsg('edition').":&nbsp;</td><td><input tabindex='1' type='text' id='metadataEdition' name='metadataEdition' value='".$metadataEdition."' maxlength='200' size='50' />
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-9'>".wfMsg('content_9')."</div>
		<td class='tooltip-target' id='cora-target-9'>".wfMsg('language').":&nbsp;</td><td><input tabindex='1' type='text' id='metadataLanguage' name='metadataLanguage' value='".$metadataLanguage."' maxlength='200' size='50' />
		</td>
	</tr>
	<!--<tr>
		<td >Has Volume:&nbsp;</td><td><input tabindex='1' type='text' id='metadataHasVolume' name='metadataHasVolume' value='".$metadataHasVolume."' maxlength='200' size='50' />
		</td>
	</tr>-->
	<tr>
	    <div class='tooltip-content' id='cora-content-10'>".wfMsg('content_10')."</div>
        <td class='tooltip-target' id='cora-target-10'>".wfMsg('number_of_volumes').":&nbsp;</td>
        <td ><select  id = 'selectoutput' name='selectoutput'  size='1' />";

	foreach($arrFormats as $format){
		$formfields .= "<option>".$format."</option>";
	}
	$formfields .= "</select>
	</td>
	<td >&nbsp;</td>
	</tr>
	<input type='hidden' name='output' id='output' />
	<tr>
	<td colspan='3'><button id='lexiconbutton'>".wfMsg('create_lexicon')."</button><button id='lexiconcancel'>".wfMsg('cancel')."</button></td>
	</tr>
	</table>
	</div>
	</form>
	</fieldset>
	</div>\n
	<br />

	";
     $formfields .=  "<div id='volume_template' >
    <fieldset id='field2'><legend>".wfMsg('volume')."</legend>
	<form id='Volume' >
	<div class = 'volumeInForm' >
	<table  id='volume_table' >
	<tr>
	    <div class='tooltip-content' id='cora-content-21'>".wfMsg('content_21')."</div>
		<td class='tooltip-target' id='cora-target-21'>".wfMsg('title')."<em>*</em>:&nbsp;</td><td><input tabindex='1' type='text' id='volumeTitle' name='volumeTitle' value='".$volumeTitle."' maxlength='200' size='50' /> <td ><label class='error' for='volumeTitle' id='title_error'>This field is required.</label> </td>
		</td>
	</tr>

	<tr>
	    <div class='tooltip-content' id='cora-content-22'>".wfMsg('content_22')."</div>
		<td class='tooltip-target' id='cora-target-22'>".wfMsg('subtitle').":&nbsp;</td><td><input tabindex='1' type='text' id='volumeSubtitle' name='volumeSubtitle' value='".$volumeSubtitle."' maxlength='200' size='50' />
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-23'>".wfMsg('content_23')."</div>
		<td class='tooltip-target' id='cora-target-23'>".wfMsg('place_of_publication')."<em>*</em>:&nbsp;</td><td><input tabindex='1' type='text' id='volumePlaceofPublication' name='volumePlaceofPublication' value='".$volumePlaceofPublication."' maxlength='200' size='50' /><td ><label class='error' for='volumePlaceofPublication' id='vplace_error'>This field is required.</label> </td>
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-24'>".wfMsg('content_24')."</div>
		<td class='tooltip-target' id='cora-target-24'>".wfMsg('year_of_publication')."<em>*</em>:&nbsp;</td><td><input tabindex='1' type='text' id='volumeYearofPublication' name='volumeYearofPublication' value='".$volumeYearofPublication."' maxlength='200' size='50' /> <td ><label class='error' for='volumeYearofPublication' id='vyear_error'>This field is required.</label> </td>
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-25'>".wfMsg('content_25')."</div>
		<td class='tooltip-target' id='cora-target-25'>".wfMsg('editor')."<em>*</em>:&nbsp;</td><td><input tabindex='1' type='text'  id='volumeEditor' name='volumeEditor' value='".$volumeEditor."' maxlength='200' size='50' /> <td ><label class='error' for='volumeEditor' id='veditor_error'>This field is required.</label> </td>
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-26'>".wfMsg('content_26')."</div>
		<td class='tooltip-target' id='cora-target-26'>".wfMsg('publisher').":&nbsp;</td><td><input tabindex='1' type='text' id='volumePublisher' name='volumePublisher' value='".$volumePublisher."' maxlength='200' size='50' />
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-27'>".wfMsg('content_27')."</div>
		<td class='tooltip-target' id='cora-target-27'>".wfMsg('language').":&nbsp;</td><td><input tabindex='1' type='text' id='volumeLanguage' name='volumeLanguage' value='".$volumeLanguage."' maxlength='200' size='50' />
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-28'>".wfMsg('content_28')."</div>
		<td class='tooltip-target' id='cora-target-28'>".wfMsg('volume_number').":&nbsp;</td><td><input tabindex='1' type='text' id='volumeNumber' name='volumeNumber' value='".$volumeNumber."' maxlength='200' size='50' />
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-29'>".wfMsg('content_29')."</div>
		<td class='tooltip-target' id='cora-target-29'>".wfMsg('physical_description').":&nbsp;</td><td><input tabindex='1' type='text' id='volumeDescription' name='volumeDescription' value='".$volumeDescription."' maxlength='200' size='50' />
		</td>
	</tr>
	<input type='hidden' name='add' id='add' />
	<tr>
	<td>
	<td colspan='3'><button id='volumebutton'>".wfMsg('create_volume')."</button><button id='volumecancel'>".wfMsg('cancel')."</button></td>
	</td>
	</tr>
	</table>
	</div>
	</form>
	</fieldset>
	</div>\n
	<br />

	";

     $formfields .=  "<div id='lemmata_template' >
    <fieldset id='field3'><legend>".wfMsg('lemmata')."</legend>
	<form id='Lemmata' >
	<table  id='lemmata_table' >
	<tr><div class='tooltip-content' id='cora-content-31'>".wfMsg('content_31')."</div>
		<td class='tooltip-target' id='cora-target-31'>".wfMsg('title')."<em>*</em>:&nbsp;</td><td><input tabindex='1' type='text' id='lemmataTitle' name='lemmataTitle' value='".$lemmataTitle."' maxlength='200' size='50' /><td ><label class='error' for='lemmataTitle' id='ltitle_error'>This field is required.</label> </td>
		</td>
	</tr>
	<tr><div class='tooltip-content' id='cora-content-32'>".wfMsg('content_32')."</div>
		<td class='tooltip-target' id='cora-target-32'>".wfMsg('type')."<em>*</em>:&nbsp;</td>
		<td><select  id='metadataType' name='metadataType'  size='1' />".
            "<option id='Lemma' value='Lemma' selected='selected'>Lemma</option>".
            "<option id='Article' value='Article'>Article</option>".
            "<option id='Preface' value='Preface'>Preface</option>".
            "<option id='TOC' value='TOC'>TOC</option>".
            "<option id='TitlePage' value='TitlePage'>TitlePage</option>".
            "</select></td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-33'>".wfMsg('content_33')."</div>
		<td class='tooltip-target' id='cora-target-33'>".wfMsg('subtitle').":&nbsp;</td><td><input tabindex='1' type='text' id='lemmataSubtitle' name='lemmataSubtitle' value='".$lemmataSubtitle."' maxlength='200' size='50' />
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-34'>".wfMsg('content_34')."</div>
		<td class='tooltip-target' id='cora-target-34'>".wfMsg('author').":&nbsp;</td><td><input tabindex='1' type='text'  id='lemmataAuthor' name='lemmataAuthor' value='".$lemmataAuthor."' maxlength='200' size='50' />
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-355'>".wfMsg('content_355')."</div>
		<td class='tooltip-target' id='cora-target-355'>".wfMsg('language').":&nbsp;</td><td><input tabindex='1' type='text' id='lemmataLanguage' name='lemmataLanguage' value='".$lemmataLanguage."' maxlength='200' size='50' />
		</td>
	</tr>
	<tr>
	<div class='tooltip-content' id='cora-content-37'>".wfMsg('content_37')."</div>
		<td class='tooltip-target' id='cora-target-37'>".wfMsg('first_page_g').":&nbsp;</td><td><input tabindex='1' type='text'  id='lemmataFirstPageN' name='lemmataFirstPageN' value='".$lemmataFirstPageN."' maxlength='200' size='50' /> <td ><label class='error' for='lemmataFirstPageN' id='lfirstN_error'>This field is required.</label> </td>
	    </td>
	</tr>
	<tr><div class='tooltip-content' id='cora-content-38'>".wfMsg('content_38')."</div>
		<td class='tooltip-target' id='cora-target-38'>".wfMsg('last_page_g').":&nbsp;</td><td><input tabindex='1' type='text' id='lemmataLastPageN' name='lemmataLastPageN' value='".$lemmataLastPageN."' maxlength='200' size='50' /> <td ><label class='error' for='lemmataLastPageN' id='llastN_error'>This field is required.</label> </td>
		</td>
	</tr>
	<tr>
	<div class='tooltip-content' id='cora-content-35'>".wfMsg('content_35')."</div>
		<td class='tooltip-target' id='cora-target-35'>".wfMsg('first_page_n')."<em>*</em>:&nbsp;</td><td><input tabindex='1' type='text'  id='lemmataFirstPage' name='lemmataFirstPage' value='".$lemmataFirstPage."' maxlength='200' size='50' /> <td ><label class='error' for='lemmataFirstPage' id='lfirst_error'>This field is required.</label> </td>
	    </td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-36'>".wfMsg('content_36')."</div>
		<td class='tooltip-target' id='cora-target-36'>".wfMsg('last_page_n')."<em>*</em>:&nbsp;</td><td><input tabindex='1' type='text' id='lemmataLastPage' name='lemmataLastPage' value='".$lemmataLastPage."' maxlength='200' size='50' /> <td ><label class='error' for='lemmataLastPage' id='llast_error'>This field is required.</label> </td>
		</td>
	</tr>
    <tr>
        <div class='tooltip-content' id='cora-content-39'>".wfMsg('content_39')."</div>
		<td class='tooltip-target' id='cora-target-39'>".wfMsg('alternate').":&nbsp;</td><td><textarea id='lemmataImages' name='lemmataImages' value='".$lemmataImages."' cols='105' rows='2'> </textarea>
		</td>
	</tr>
	<tr>
	    <div class='tooltip-content' id='cora-content-40'>".wfMsg('content_40')."</div>
		<td class='tooltip-target' id='cora-target-40'>".wfMsg('rights_holder').":&nbsp;</td><td><textarea id='lemmataRights' name='lemmataRights' value='".$lemmataRights."' cols='105' rows='2'> </textarea>
		</td>
	</tr>
	<input type='hidden' name='addLemmata' id='addLemmata' />
	<tr>
	<td colspan='4'><button id='lemmatabutton'>".wfMsg('create_lemma')."</button><button id='newmediabutton'>".wfMsg('add_media')."</button><button id='lemmatacancel'>".wfMsg('cancel')."</button><button id='lemmatarefresh'>".wfMsg('refresh')."</button></td>
	</tr>
	</table>
	</form>
	</fieldset>
	</div>
	</div>\n
	<br />

	";
    $wgOut->addHTML($formfields);
     }

	}
    function pageExists($title){
		$articleTitle = Title::newFromText($title);
		$ex = false;
		if($articleTitle instanceof Title ){
			$ex = $articleTitle->exists();
		}
		return $ex;
	}

	function savePage($title, $content, $doNotUpdate = false, $flag, $summary = "New wiki page has been created."){
		global  $wgUser;

		$flags = $flag;
		$titleObj = Title::newFromtext($title);

		$article = new Article($titleObj);
		$flags = $flags|EDIT_DEFER_UPDATES | EDIT_AUTOSUMMARY;
		$status = $article->doEdit( $content, $summary, $flags,false,$wgUser);
		$result = true;
		if(!$status->isOK()){
			$result = $status->getErrorsArray();
		}
		return $result;
	}

    function createImage($text,$file_name){
        $my_img = imagecreate( 200, 80 );
        $background = imagecolorallocate( $my_img, 0, 0, 255 );
        $text_colour = imagecolorallocate( $my_img, 255, 255, 0 );
        $line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
        imagestring( $my_img, 4, 30, 25, $text, $text_colour );
        imagesetthickness ( $my_img, 5 );
        imageline( $my_img, 30, 45, 165, 45, $line_colour );

       // header( "Content-type: image/png" );
     //   imagepng( $my_img );
        imagepng( $my_img, $file_name.".png" );
        imagejpeg($my_img, $file_name.".jpg");
        imagecolordeallocate( $my_img, $line_colour );
        imagecolordeallocate( $my_img, $text_colour );
        imagecolordeallocate( $my_img, $background );
        imagedestroy( $my_img );
    }
}

