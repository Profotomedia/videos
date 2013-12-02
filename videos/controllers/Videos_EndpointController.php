<?php

/**
 * Craft Videos by Dukt
 *
 * @package   Craft Videos
 * @author    Benjamin David
 * @copyright Copyright (c) 2013, Dukt
 * @license   http://docs.dukt.net/craft/videos/license
 * @link      http://dukt.net/craft/videos
 */

namespace Craft;

require_once(CRAFT_PLUGINS_PATH.'videos/vendor/autoload.php');

class Videos_EndpointController extends BaseController
{
	public function init()
	{
		$method = craft()->request->getParam('method');

		$this->{$method}();
	}

    public function app()
    {
    	$variables = array();

        $html = craft()->templates->render('videos/_includes/app', $variables);

        $this->returnJson(array(
        	'html' => $html
        ));
    }

    private function _embedOptions()
    {
        $options = array(
            'autoplay' => '0',
            'controls' => 1,
            'showinfo' => 1,
            'iv_load_policy' => 3,
            'rel' => 0
        );

        $post = $this->_requestPayload();

        if(!empty($post['embedOptions'])) {
            $options = array_merge($options, $post['embedOptions']);
        }

        return $options;
    }

    public function embed()
    {
        $videoUrl = craft()->request->getPost('videoUrl');

        $options = $this->_embedOptions();

        $video = craft()->videos->url($videoUrl);

        $embed = $video->getEmbedHtml($options);

        $this->returnJson(array(
        	'embed' => $embed
        ));
    }

    public function embedUrl()
    {
        // video

        $post = $this->_requestPayload();

        $videoUrl = $post['videoUrl'];

        $video = craft()->videos->url($videoUrl);


        // embed

        $options = $this->_embedOptions();

        $embedUrl = $video->getEmbedUrl($options);


        // return json

        $this->returnJson(array(
            'embedUrl' => $embedUrl
        ));
    }

    public function sources()
    {
        $sources = craft()->videos->getGatewaysWithSections();

        $this->returnJson(array(
            'sources' => $sources
        ));

        // // get providers

        // $sources = ee()->videos_lib->getSources();

        // foreach($sources as $k => $source) {

        //     $source->supportsOwnVideoLike = $source->supportsOwnVideoLike();

        //     // $source->sections =  $source->getSections();

        //     $class = '\\Videos\\Section\\'.$source->providerClass;

        //     $source->sections =  $class::getSections($source);

        //     $sources[$k] = $source;
        // }

        // $result = array('result' => $sources);

        // return Helper::returnJson($result);
    }

	// public function actionGetProviders()
	// {
	// 	craft()->videos->getProviders();
	// }

    // request payload parameters

    private function _requestPayload()
    {
        $post = "";

        $fp = fopen("php://input", "r");

        while (!feof($fp)) {
           $line = fgets($fp);
           $post .= $line;
        }

        fclose($fp);

        $post = json_decode($post, true);

        return $post;
    }

    public function routeRequest()
    {
        $post = $this->_requestPayload();

        $uri = $post['path'];

        $uri = trim($uri, "/");

        $segments = explode("/", $uri);

        $gatewayHandle = $segments[0];

        $params = array();

        if(!empty($segments[2])) {
            $params['id'] = $segments[2];
        }

        $request = substr($post['path'], strlen("/".$gatewayHandle."/"));

        $videos = craft()->videos->getVideos($gatewayHandle, $request, $params);

        $this->returnJson($videos);
    }

	public function getVideos()
	{
        $gateway = craft()->request->getParam('gateway');

        $params = $this->_requestPayload();

        $request = $params['request'];

		$videos = craft()->videos->getVideos($gateway, $request, $params);

        $this->returnJson($videos);
	}
}