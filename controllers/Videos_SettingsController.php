<?php

/**
 * Craft Videos
 *
 * @package		Craft Videos
 * @version		Version 1.0
 * @author		Benjamin David
 * @copyright	Copyright (c) 2013 - DUKT
 * @link		http://dukt.net/add-ons/expressionengine/dukt-videos/
 *
 */

namespace Craft;

require(CRAFT_PLUGINS_PATH.'videos/vendor/autoload.php');

class Videos_SettingsController extends BaseController
{
    // --------------------------------------------------------------------

    public function actionSaveService()
    {
        $providerClass = craft()->request->getSegment(3);

        $serviceModelClass = "\Craft\Videos_Service".$providerClass."Model";

        $model = new $serviceModelClass();

        $attributes = craft()->request->getPost('service');

        $attributes['providerClass'] = $providerClass;

        $model->setAttributes($attributes);

        if (craft()->videos->saveService($model)) {

            craft()->userSession->setNotice(Craft::t('Service saved.'));

            $this->redirectToPostedUrl();
        } else {

            craft()->userSession->setError(Craft::t("Couldn't save service."));

            craft()->urlManager->setRouteVariables(array('service' => $model));
        }
    }

	// --------------------------------------------------------------------

    public function actionEnableService()
    {
	    $service_key = craft()->request->getSegment(5);

	    $option_key = $service_key."_enabled";

		craft()->videos->setOption($option_key, 1);

		$this->redirect('videos');
    }

	// --------------------------------------------------------------------

    public function actionDisableService()
    {
	    $service_key = craft()->request->getSegment(5);

	    $option_key = $service_key."_enabled";

		craft()->videos->setOption($option_key, 0);

		$this->redirect('videos');
    }

    // --------------------------------------------------------------------

    public function actionServiceCallback()
    {
        craft()->videos->connectService();
    }

    // --------------------------------------------------------------------

    public function actionResetService()
    {
		$providerClass = craft()->request->getParam('providerClass');

		craft()->videos->resetService($providerClass);

		$this->redirect('videos/settings/'.$providerClass);
    }

    // --------------------------------------------------------------------

    public function actionRefreshServiceToken()
    {
        $providerClass = craft()->request->getParam('providerClass');

        craft()->videos->refreshServiceToken($providerClass);

        $this->redirect('videos/settings/'.$providerClass);
    }

    // --------------------------------------------------------------------
}