<?php
namespace KAFWPB\Traits;

trait DependenciesCheckPoint {
	/**
     * Check if all required dependencies are met.
     *
     * @return bool
     */
    public function are_dependencies_met() {

		return ( defined( 'KAFWPB_PLUGIN_DEPENDENCIES_STATUS' )
								&& KAFWPB_PLUGIN_DEPENDENCIES_STATUS === 1
							) ? false : true;
	}
}
