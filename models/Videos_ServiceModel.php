<?php

namespace Craft;

class Videos_ServiceModel extends BaseModel
{
    // --------------------------------------------------------------------

    /**
     * Define Attributes
     */
    public function defineAttributes()
    {
        $attributes = array(
                'id'    => AttributeType::Number,
                'providerClass' => array(AttributeType::String, 'required' => true),
                'clientId' => array(AttributeType::String, 'required' => true),
                'clientSecret' => array(AttributeType::String, 'required' => true),
                'token' => array(AttributeType::Mixed)
            );

        return $attributes;
    }
}