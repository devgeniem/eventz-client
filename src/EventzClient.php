<?php
/**
 * Copyright (c) 2023. Geniem Oy
 */

namespace Geniem\Eventz;

use WpOrg\Requests\Requests;

/**
 * Class EventzClient
 *
 * @package Geniem\Eventz
 */
class EventzClient {

    /**
     * API base URI.
     *
     * @var string
     */
    private string $base_uri;

    /**
     * API key.
     *
     * @var string
     */
    private string $api_key;

    /**
     * EventzClient constructor.
     *
     * @param string $base_uri API Base URI.
     * @param string $api_key API key.
     * @throws \InvalidArgumentException If base URI or API key is not valid.
     */
    public function __construct( string $base_uri, string $api_key ) {
        $base_uri = filter_var( $base_uri, FILTER_SANITIZE_URL );
        if ( empty( $base_uri ) || ! filter_var( $base_uri, FILTER_VALIDATE_URL ) ) {
            throw new \InvalidArgumentException( 'Base URI is not valid.' );
        }
        if ( empty( $api_key ) ) {
            throw new \InvalidArgumentException( 'API key is not valid.' );
        }

        $this->base_uri = trim( rtrim( $base_uri, '/ \t\n\r\0\x0B' ) ); // We'll set the last slash.
        $this->api_key  = $api_key;
    }

    /**
     * Search items from API.
     *
     * @param array $params Search parameters.
     * @return void
     */
    public function search( array $params = [] ) {
        $endpoint = 'api/public/search';
        $api_url  = $this->base_uri . $endpoint . '?' . $this->to_query_parameters( $params );

        $this->do_get_request( $api_url );
    }

    /**
     * Inject API key to parameters and return query string.
     *
     * @param array $params The query parameters.
     * @return string
     */
    protected function to_query_parameters( array $params = [] ) {
        $default_params = [
            'apiKey' => $this->api_key,
        ];
        $params         = array_merge( $default_params, $params );

        return http_build_query( $params );
    }

    /**
     * Get request body from API by URL.
     *
     * @param string $api_url API URL to fetch from.
     * @return string|false
     */
    public function do_get_request( string $api_url = '' ) {
        if ( empty( $api_url ) || ! filter_var( $api_url, FILTER_VALIDATE_URL ) ) {
            return false;
        }

        $payload = Requests::get( $api_url );
        echo '<pre>';
        var_dump( $payload );
        echo '</pre>';

        return '';
    }
}
