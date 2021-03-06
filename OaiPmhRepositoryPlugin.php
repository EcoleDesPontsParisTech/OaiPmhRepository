<?php
/**
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright John Flatness, Center for History and New Media, 2013-2014
 * @package OaiPmhRepository
 */
 
define('OAI_PMH_BASE_URL',WEB_ROOT.'/oai-pmh-repository/request');
define('OAI_PMH_REPOSITORY_PLUGIN_DIRECTORY',dirname(__FILE__));
define('OAI_PMH_REPOSITORY_METADATA_DIRECTORY',OAI_PMH_REPOSITORY_PLUGIN_DIRECTORY.'/metadata');
 
 /**
  * OaiPmhRepository plugin class
  *
  * @package OaiPmhRepository
  */
class OaiPmhRepositoryPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array(
        'install',
        'config_form',
        'config',
        'uninstall'
    );
    
    protected $_filters = array(
        'admin_dashboard_panels'
    );
    
    protected $_options = array(
        'oaipmh_repository_name',
        'oaipmh_repository_namespace_id',
        'oaipmh_repository_expose_files',
        'oaipmh_repository_expose_empty_collections' => 1,
    );
    
    /**
     * OaiPmhRepository install hook.
     */
    public function hookInstall()
    {
        set_option('oaipmh_repository_name', get_option('site_title'));
        set_option('oaipmh_repository_namespace_id', $this->_getServerName());
        set_option('oaipmh_repository_namespace_expose_files', 1);

        $db = get_db();
        /* Table: Stores currently active resumptionTokens

           id: primary key (also the value of the token)
           verb: Verb of original request
           metadata_prefix: metadataPrefix of original request
           cursor: Position of cursor within result set
           from: Optional from argument of original request
           until: Optional until argument of original request
           set: Optional set argument of original request
           expiration: Datestamp after which token is expired
        */
        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS `{$db->prefix}oai_pmh_repository_tokens` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `verb` ENUM('ListIdentifiers', 'ListRecords', 'ListSets') COLLATE utf8_unicode_ci NOT NULL,
    `metadata_prefix` TEXT COLLATE utf8_unicode_ci NOT NULL,
    `cursor` INT(10) UNSIGNED NOT NULL,
    `from` DATETIME DEFAULT NULL,
    `until` DATETIME DEFAULT NULL,
    `set` INT(10) UNSIGNED DEFAULT NULL,
    `expiration` DATETIME NOT NULL,
    PRIMARY KEY  (`id`),
    INDEX(`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
SQL;
        $db->query($sql);
    }

    public function hookUninstall()
    {
        delete_option('oaipmh_repository_name');
        delete_option('oaipmh_repository_namespace_id');
        delete_option('oaipmh_repository_record_limit');
        delete_option('oaipmh_repository_expiration_time');
        delete_option('oaipmh_repository_expose_files');

        $db = get_db();
        $sql = "DROP TABLE IF EXISTS `{$db->prefix}oai_pmh_repository_tokens`;";
        $db->query($sql);
    }

    public function hookConfig()
    {
        set_option('oaipmh_repository_name', $_POST['oaipmh_repository_name']);
        set_option('oaipmh_repository_namespace_id', $_POST['oaipmh_repository_namespace_id']);
        set_option('oaipmh_repository_expose_files', $_POST['oaipmh_repository_expose_files']);
        set_option('oaipmh_repository_expose_empty_collections', $_POST['oaipmh_repository_expose_empty_collections']);
    }

    public function hookConfigForm()
    {
        $repoName = get_option('oaipmh_repository_name');
        $namespaceID = get_option('oaipmh_repository_namespace_id');
        $exposeFiles = get_option('oaipmh_repository_expose_files');
        include('config_form.php');
    }

    public function filterAdminDashboardPanels($panels)
    {
        ob_start();
?>
<h2>OAI-PMH Repository</h2>
<p>Harvester can access metadata from this site
<a href="<?php echo OAI_PMH_BASE_URL; ?>"><?php echo OAI_PMH_BASE_URL; ?></a></p>
<?php
        $panels[] = ob_get_clean();
        return $panels;
    }

    private function _getServerName()
    {
        $name = preg_replace('/[^a-z0-9\-\.]/i', '', $_SERVER['SERVER_NAME']);
        if ($name == 'localhost') {
            $name = 'default.must.change';
        }

        return $name;
    }
}
