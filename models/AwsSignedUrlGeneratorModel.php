<?php
/**
 * AWS Signed URL Generator plugin for Craft CMS
 *
 * AwsSignedUrlGenerator Model
 *
 * --snip--
 * Models are containers for data. Just about every time information is passed between services, controllers, and
 * templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 * --snip--
 *
 * @author    Jonathan Melville
 * @copyright Copyright (c) 2016 Jonathan Melville
 * @link      http://jonathanmelville.com
 * @package   AwsSignedUrlGenerator
 * @since     1.0.0
 */

namespace Craft;

class AwsSignedUrlGeneratorModel extends BaseModel
{
    /**
     * Defines this model's attributes.
     *
     * @return array
     */
    protected function defineAttributes()
    {
        return array_merge(parent::defineAttributes(), array(
            'someField'     => array(AttributeType::String, 'default' => 'some value'),
        ));
    }

}