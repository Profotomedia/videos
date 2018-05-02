Changelog
=========

## 2.0.0-beta.7 - 2018-04-27

### Changed
- Updated dukt/oauth2-vimeo dependency to `^2.0.1`.

### Fixed
- Fixed namespacing bug in `\dukt\videos\services\Cache`. ([#4](https://github.com/dukt/videos/issues/4))
- Fixed a bug where the explorer modal’s spinner was not properly positionned.
- Fixed authentication bug with Vimeo.

## 2.0.0-beta.6 - 2017-12-17

### Changed
- Updated to require craftcms/cms `^3.0.0-RC1`.
- Updated plugin icon.

### Fixed
- Fixed layout bug with the video explorer.

### Removed
- Removed ununsed mask icon.

## 2.0.0-beta.5 - 2017-09-24

### Added
- Added the `registerGatewayTypes` to `dukt\videos\services\Gateways`, giving plugins a chance to register gateway types (replacing `getVideosGateways()`).
- Added `dukt\videos\events\RegisterGatewayTypesEvent`.

### Improved
- Now using the `craft\web\twig\variables\CraftVariable`’s `init` event to register Videos’ variable class, replacing the now-deprecated `defineComponents`.
- Removed `dukt\videos\Plugin::getVideosGateways()`.

## 2.0.0-beta.4 - 2017-09-22

### Changed
- The plugin now requires Craft 3.0.0-beta.27 or above.

### Fixed 
- Fixed video thumbnails for Craft 3.0.0-beta.27 and above where resource URLs are not supported anymore.

## 2.0.0-beta.3 - 2017-08-28

### Fixed

- Fixed `\dukt\videos\fields\Video` to use `normalizeValue()`. ([#2](https://github.com/dukt/videos/issues/2))

## 2.0.0-beta.2 - 2017-08-28

### Added

- Added `dukt\videos\services\Oauth::getTokenData()`.

### Improved

- Check that there is an `expires` value before trying to refresh the token in `dukt\videos\base\Gateway::createTokenFromData()`.
- Moved `dukt\videos\base\Gateway::createTokenFromData()` to `dukt\videos\services\Oauth::createTokenFromData()`.
- Renamed `dukt\videos\base\Gateway::getToken()` to `getOauthToken()`.
- Instantiating video gateways doesn’t require a refreshed token anymore.
- Improved error handling for the settings index page.
- Improved error handling for the gateway details page.
- Replaced `dukt\videos\base\Gateway::parseJson()` with `craft\helpers\Json::decode()`.
- Replaced `dukt\videos\fields\Video::prepValue()` with `normalizeValue()`. ([#1](https://github.com/dukt/videos/issues/1))

### Fixed

- Fixed a bug where `dukt\videos\services\Oauth::getToken()` would crash if the token didn’t exists for the given gateway.


## 2.0.0-beta.1 - 2017-08-25

### Added

- Craft 3 compatibility.
- Added `review_link` to the list of fields returned by the Vimeo API for a video.
- Added YouTube and Vimeo SVG icons
- Added “Like videos” support for the YouTube gateway.
- Added `dukt\videos\base\Gateway::getJavascriptOrigin()`.
- Added `dukt\videos\base\Gateway::getOauthProviderName()`.
- Added `dukt\videos\base\Gateway::getRedirectUri()`.
- Added `dukt\videos\base\Gateway::getVideosPerPage()`.
- Added `dukt\videos\base\GatewayInterface::createOauthProvider()`.
- Added `dukt\videos\base\GatewayInterface::getIconAlias()`.
- Added `dukt\videos\base\GatewayInterface::getOauthProviderApiConsoleUrl()`.
- Added `dukt\videos\base\PluginTrait`.
- Added `dukt\videos\errors\ApiResponseException`.
- Added `dukt\videos\errors\CollectionParsingException`.
- Added `dukt\videos\errors\GatewayMethodNotFoundException`.
- Added `dukt\videos\errors\GatewayNotFoundException`.
- Added `dukt\videos\errors\JsonParsingException`.
- Added `dukt\videos\errors\VideoNotFoundException`.
- Added `dukt\videos\models\Settings`.
- Added `dukt\videos\web\assets\settings\SettingsAsset`.
- Added `dukt\videos\web\assets\videofield\VideoFieldAsset`.
- Added `dukt\videos\web\assets\videos\VideosAsset`.

### Changed

- OAuth provider options are now using gateway’s handle instead of oauth provider’s handle as a key.
- Removed dependency with `dukt/oauth`
- Search support is disabled by default and gateways can enable it by defining a `supportsSearch()` method returning `true`.
- Moved `dukt\videos\controllers\VideosController::actionFieldPreview()` to `dukt\videos\controllers\ExplorerController::actionFieldPreview()`.
- Moved `dukt\videos\controllers\VideosController::actionPlayer()` to `dukt\videos\controllers\ExplorerController::actionPlayer()`.
- Removed `Craft\Videos_InstallController`.
- Removed `Craft\VideosController`.
- Removed `dukt\videos\models\Settings::$youtubeParameters`.
- Renamed `Craft\Videos_CacheService` to `dukt\videos\services\Cache`.
- Renamed `Craft\Videos_CollectionModel` to `dukt\videos\models\Collection`.
- Renamed `Craft\Videos_GatewaysService` to `dukt\videos\services\Gateways`.
- Renamed `Craft\Videos_OauthController` to `dukt\videos\controllers\OauthController`.
- Renamed `Craft\Videos_OauthService` to `dukt\videos\services\Oauth`.
- Renamed `Craft\Videos_SectionModel` to `dukt\videos\models\Section`.
- Renamed `Craft\Videos_SettingsController` to `dukt\videos\controllers\SettingsController`.
- Renamed `Craft\Videos_VideoFieldType` to `dukt\videos\fields\Video`.
- Renamed `Craft\Videos_VideoModel` to `dukt\videos\models\Video`.
- Renamed `Craft\VideosController` to `dukt\videos\controllers\ExplorerController`.
- Renamed `Craft\VideosHelper` to `dukt\videos\helpers\VideosHelper`.
- Renamed `Craft\VideosService` to `dukt\videos\services\Videos`.
- Renamed `Craft\VideosVariable` to `dukt\videos\web\twig\variables\VideosVariable`.
- Renamed `dukt\videos\base\Gateway::apiGet()` to `get()`.
- Renamed `dukt\videos\base\Gateway::authenticationSetToken()` to `setAuthenticationToken()`.
- Renamed `Dukt\Videos\Gateways\BaseGateway` to `dukt\videos\base\Gateway`.
- Renamed `Dukt\Videos\Gateways\IGateway` to `dukt\videos\base\GatewayInterface`.
- Renamed `Dukt\Videos\Gateways\Vimeo` to `dukt\videos\gateways\Vimeo`.
- Renamed `Dukt\Videos\Gateways\Youtube` to `dukt\videos\gateways\YouTube`.


### Fixed

- Fixed a bug where token when not being properly refreshed in `dukt\videos\services\Gateways::loadGateways()`.
- Fixed success message when connecting to Vimeo.
- Fixed Vimeo’s console API URL.
- Fixed YouTube’s OAuth provider API console URL.