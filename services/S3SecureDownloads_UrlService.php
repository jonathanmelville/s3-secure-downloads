<?php

namespace Craft;

class S3SecureDownloads_UrlService extends BaseApplicationComponent
{

	public function getSetting( $setting_name ) {
		$plugin = craft()->plugins->getPlugin( 's3SecureDownloads' );
		$settings = $plugin->getSettings();

		return $settings->$setting_name;
	}

	public function getSignedUrl( $entry_id ) {

		$entry = craft()->elements->getElementById( $entry_id, ElementType::Asset );
		$fileName = $entry->filename;

		$sourceType = craft()->assetSources->getSourceTypeById( $entry->sourceId );
		$assetSettings = $sourceType->getSettings();
		$bucketName = $assetSettings->bucket;

		// Add slash to end of path, since subfolder may not have it
		// https://stackoverflow.com/a/9339669/864799
		$urlPrefix = rtrim( $assetSettings->subfolder, "/" ) . "/";

		$baseAssetPath = $urlPrefix . $fileName;
		$keyId = $assetSettings->keyId;
		$secretKey = $assetSettings->secret;
		$linkExpirationTime = $this->getSetting( "linkExpirationTime" );
		$forceDownload = $this->getSetting( "forceFileDownload" );



		$expires = time()+$linkExpirationTime;

		// S3 Signed URL creation

		$headers = array();

		if($forceDownload) {
			$headers["response-content-disposition"] = "attachment; filename=" . $fileName;
		}

		$resource = str_replace( array( '%2F', '%2B' ), array( '/', '+' ), rawurlencode( $baseAssetPath ) );

		$string_to_sign = "GET\n\n\n{$expires}\n/{$bucketName}/{$resource}";
		$final_url = "https://{$bucketName}.s3.amazonaws.com/{$resource}?";

		$append_char = '?';
		foreach ( $headers as $header => $value ) {
			$final_url .= $header . '=' . urlencode( $value ) . '&';
			$string_to_sign .= $append_char . $header . '=' . $value;
			$append_char = '&';
		}

		$signature = urlencode( base64_encode( hash_hmac( 'sha1', $string_to_sign, $secretKey, true ) ) );

		return $final_url . "AWSAccessKeyId=$keyId&Expires=$expires&Signature=$signature";


	}
}
