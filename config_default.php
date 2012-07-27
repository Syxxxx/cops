<?php
/**
 * COPS (Calibre OPDS PHP Server) class file
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     S�bastien Lucas <sebastien@slucas.fr>
 */

    if (!isset($config))
        $config = array();
  
    /*
     * The directory containing calibre's metadata.db file, with sub-directories
     * containing all the formats.
     * If this directory starts with a / EPUB download will only work with Nginx
     * and the calibre_internal_directory has to be set properly
     * BEWARE : it has to end with a /
     */
    $config['calibre_directory'] = './';
    
    /*
     * The internal directory set in nginx config file
     * or the same directory as calibre_directory with X-Sendfile
     */
    $config['calibre_internal_directory'] = '/Calibre/'; 

    /*
     * Full URL prefix (with trailing /)
     * usefull especially for Opensearch where a full URL is sometimes required
     * For example Mantano requires it.
     */
    $config['cops_full_url'] = ''; 
    
    /*
     * Number of recent books to show
     */
    $config['cops_recentbooks_limit'] = '50'; 
    
    /*
     * The internal directory set in nginx config file
     */
    $config['cops_title_default'] = "COPS"; 

    
    /*
     * Wich header to use when downloading books outside the web directory
     * Possible values are :
     *   X-Accel-Redirect : For Nginx
     *   X-Sendfile : For Lightttpd or Apache (with mod_xsendfile)
     *   direct : if your calibre_internal_directory is not in your docroot use readfile insted
     */
    $config['cops_x_accel_redirect'] = "direct";
    
    /*
     * Height of thumbnail image for OPDS
     */
    $config['cops_opds_thumbnail_height'] = "40";
    
    /*
     * Height of thumbnail image for HTML
     */
    $config['cops_html_thumbnail_height'] = "70";
    
    /*
     * Show icon for authors, series, tags and books on OPDS feed
     *  1 : enable
     *  0 : disable
     */
    $config['cops_show_icons'] = "1";
    
    /*
     * Default timezone 
     * Check following link for other timezones :
     * http://www.php.net/manual/en/timezones.php
     */
    $config['default_timezone'] = "Europe/Paris";
    
    /*
     * Prefered format for HTML catalog
     * The two first will be displayed in book entries
     * The other only appear in book detail
     */
    $config['cops_prefered_format'] = array ("EPUB", "PDF", "MOBI", "CBR", "CBZ");
    
    /*
     * use URL rewriting for downloading of ebook in HTML catalog
     * See README for more information
     *  1 : enable
     *  0 : disable
     */
    $config['cops_use_url_rewriting'] = "0";
?>