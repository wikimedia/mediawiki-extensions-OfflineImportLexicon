<?php
/**
 * @author Lia Veja
 * @copyright 2012 Lia Veja
 */
/*
    Copyright (c) 2012 Lia Veja

	This work is licensed under the Creative Commons
	Attribution-NonCommercial-ShareAlike 3.0
	Unported License. To view a copy of this license,
	visit http://creativecommons.org/licenses/by-nc-sa/3.0/
	or send a letter to Creative Commons,
	171 Second Street, Suite 300, San Francisco,
	California, 94105, USA.

 */
if ( !defined( 'MEDIAWIKI' ) ) {
	echo "This file is not a valid entry point.";
	exit( 1 );
}

$wgExtensionCredits['other'][] = array(
        'path' => __FILE__,
        'name' => 'OfflineImportLexicon',
        'version' => '0.3.0.0',
        'url' => 'http://www.mediawiki.org/wiki/Extension:OfflineImportLexicon',
        'descriptionmsg' => 'description',
        'author' => array( 'Lia Veja' )
);
$dir = dirname(__FILE__) . '/';
$wgSpecialPages['OfflineImportLexicon'] = 'OfflineImportLexicon';
$wgExtensionMessagesFiles['OfflineImportLexicon'] = $dir .'languages/OfflineImportLexicon.i18n.php';
$wgExtensionMessagesFiles['OfflineImportLexiconAlias'] = $dir . 'OfflineImportLexicon.alias.php';
$wgAutoloadClasses['OfflineImportLexicon'] = $dir . 'OfflineImportLexicon_body.php';
$wgSpecialPageGroups['OfflineImportLexicon'] = 'smw_group';

$wgGroupPermissions['user']['offlineimportlexicon'] = true;

// Hook things up
$wgHooks['BeforePageDisplay'][] = 'ResourcesJSJ';
$wgHooks['SkinAfterContent'][] = 'GetFormF';
$wgHooks['ArticleSaveComplete'][] = 'CheckSave';

$wgResourceModules['ext.OfflineImportLexicon'] = array(
		'scripts' => array('scripts/OIL_Constants.js', 'scripts/jquery.ezpz_tooltip.min.js', 'scripts/OfflineImportLexicon.js', 'scripts/OfflineImportLexiconSecond.js'),
		'styles' => array('styles/OfflineImportLexicon.css'),
		'localBasePath' => dirname( __FILE__ ),
        'remoteExtPath' => 'OfflineImportLexicon'
	);

/**
 * Adds required JavaScript & CSS files to the HTML output of a page
 *
 * @param $out OutputPage object
 * @return true
 */
function ResourcesJSJ( OutputPage $out ) {
	global $IP, $wgScriptPath, $wgExtensionAssetsPath, $wgTitle;
    if($wgTitle->getDBkey() == 'OfflineImportLexicon'){
        // Our custom CSS
     //   $out->addExtensionStyle( $wgScriptPath.'/NonSvnExtensions/OfflineImportLexicon/OfflineImportLexicon.css' );
        $out->includeJQuery();
      //  $out->addScriptFile( $wgScriptPath . '/NonSvnExtensions/OfflineImportLexicon/jquery.ezpz_tooltip.min.js' );
      //   $out->addScriptFile( $wgScriptPath . '/NonSvnExtensions/OfflineImportLexicon/OIL_Constants.js' );
      //  $out->addScriptFile( $wgScriptPath . '/NonSvnExtensions/OfflineImportLexicon/OfflineImportLexicon.js' );
      //  $out->addScriptFile( $wgScriptPath . '/NonSvnExtensions/OfflineImportLexicon/OfflineImportLexiconSecond.js' );
        $out->addModules('ext.OfflineImportLexicon');
    }
	return true;
}
function GetFormF( &$data, $skin = null ) {
	global  $wgOut, $wgUser, $wgExtensionAssetsPath;

        if( is_null( $skin ) ) {
                global $wgTitle;
                $check = $wgTitle->getNamespace() == -1 && $wgTitle->getDBkey() == 'OfflineImportLexicon';
            } else {
                $check = $skin->getTitle()->isSpecial( 'OfflineImportLexicon' );
            }
        if( $check )
        {
        $titleObj = SpecialPage::getTitleFor( 'OfflineImportLexicon' );
 }
 return true;
}


/**
	$article: the article (object) saved
	$user: the user (object) who saved the article
	$text: the new article text
	$summary: the article summary (comment)
	$isminor: minor flag
	$iswatch: watch flag
	$section: section #
*/

function CheckSave(  $article, $user) {
    global $wgOut, $wgScriptPath;

    $articleId = $article->getID();
    $articleTitle = $article -> getTitle();
	$userId = $user->getName();

	$dbw = wfGetDB( DB_MASTER );

	$wgOut->addHTML(
		'<div id="lexicon-se" style="display:none;">'
		. '<p id="lexicon-se-editors">' . $articleTitle . '</p>'
		. '</div>'
		);
	//$wgOut->addScriptFile(  $wgScriptPath . '/NonSvnExtensions/OfflineImportLexicon/second.js'  );
	return true;
}


