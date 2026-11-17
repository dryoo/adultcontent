<?php
/**
 * adultcontent plugin
 *
 * Flags pages that mention adult content so templates can leave out ads.
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     S.C. yoo <dryoo@live.com>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class action_plugin_adultcontent extends DokuWiki_Action_Plugin {

    /**
     * Registers a callback function for a given event
     *
     * @param Doku_Event_Handler $controller
     */
    public function register(Doku_Event_Handler $controller) {
        $controller->register_hook('IO_WIKIPAGE_WRITE', 'BEFORE', $this, 'check');
    }

    /**
     * Look for the configured keywords and store the result as page metadata.
     *
     * The page id is taken from the event instead of the global $ID, so
     * programmatic writes to another page are flagged correctly, and old
     * revisions are skipped.
     *
     * @param Doku_Event $event
     * @param mixed $param
     */
    public function check(Doku_Event $event, $param) {
        // only the current revision matters
        if (!empty($event->data[3])) return;

        $id = $event->data[1] === '' ? $event->data[2] : $event->data[1] . ':' . $event->data[2];
        if ($id === '') return;

        $pattern = $this->getPattern();
        if ($pattern === null) return;

        $adult = (bool) preg_match($pattern, $event->data[0][1]);
        p_set_metadata($id, array('adult' => $adult));
    }

    /**
     * Compile the configured keyword list into a regex.
     *
     * '#' is used as delimiter so slashes in the configuration (URLs,
     * "and/or", ...) do not break the pattern. An empty or invalid
     * configuration returns null and leaves the metadata untouched.
     *
     * @return string|null
     */
    protected function getPattern() {
        $regex = trim((string) $this->getConf('keywords'));
        if ($regex === '') return null;

        $pattern = '#' . str_replace('#', '\#', $regex) . '#si';
        if (@preg_match($pattern, '') === false) return null;

        return $pattern;
    }
}
