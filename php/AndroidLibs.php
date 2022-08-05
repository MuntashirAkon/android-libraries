<?php
// SPDX-License-Identifier: AGPL-3.0-or-later

require_once __DIR__ . '/AndroidLibV1.php';

class AndroidLibs {
    /**
     * @var AndroidLibV1[]
     */
    private array $libs = array();

    /**
     * @throws Exception
     */
    public function addLib(AndroidLibV1 $lib) : bool {
        if (isset($this->libs[$lib->id])) {
            // Duplicate value: Check nulls and add the non-null ones
            $old_lib = $this->libs[$lib->id];
            if ($lib->label != $old_lib->label) {
                throw new Exception("Label didn't match: Expected label {$old_lib->label}, actual label {$lib->label}", 1);
            }
            if ($lib->exodus_id != null) {
                if ($old_lib->exodus_id == null) {
                    $old_lib->exodus_id = $lib->exodus_id;
                } else if ($old_lib->exodus_id != $lib->exodus_id) {
                    throw new Exception("Exodus ID didn't match: {$old_lib->exodus_id}, actual ID {$lib->exodus_id}", 1);
                }
            }
            if ($lib->etip_id != null) {
                if ($old_lib->etip_id == null) {
                    $old_lib->etip_id = $lib->etip_id;
                } else if ($old_lib->etip_id != $lib->etip_id) {
                    throw new Exception("ETIP ID didn't match: {$old_lib->etip_id}, actual ID {$lib->etip_id}", 1);
                }
            }
            if ($lib->code_signatures != null) {
                if ($old_lib->code_signatures == null) {
                    $old_lib->code_signatures = $lib->code_signatures;
                } else if ($old_lib->code_signatures != $lib->code_signatures) {
                    throw new Exception("Code signatures didn't match: {$old_lib->code_signatures}, actual signature {$lib->code_signatures}", 1);
                }
            }
            if ($lib->network_signatures != null) {
                if ($old_lib->network_signatures == null) {
                    $old_lib->network_signatures = $lib->network_signatures;
                } else if ($old_lib->network_signatures != $lib->network_signatures) {
                    throw new Exception("Network signatures didn't match: {$old_lib->network_signatures}, actual signature {$lib->network_signatures}", 1);
                }
            }
            if ($lib->solib_signatures != null) {
                if ($old_lib->solib_signatures == null) {
                    $old_lib->solib_signatures = $lib->solib_signatures;
                } else if ($old_lib->solib_signatures != $lib->solib_signatures) {
                    throw new Exception("Solib signatures didn't match: {$old_lib->solib_signatures}, actual signature {$lib->solib_signatures}", 1);
                }
            }
            if ($old_lib->type != $lib->type) {
                // Update type
                $old_lib->type = $lib->type;
            }
            if ($lib->website != null && $old_lib->website != $lib->website) {
                // Update website
                $old_lib->website = $lib->website;
            }
            if ($lib->description != null && $old_lib->description != $lib->description) {
                // Update description
                $old_lib->description = $lib->description;
            }
            if ($lib->anti_features != null && $old_lib->anti_features != $lib->anti_features) {
                // Update AntiFeatures
                $old_lib->anti_features = $lib->anti_features;
            }
            // TODO: Update others
            $this->libs[$lib->id] = $old_lib;
            return false;
        } else {
            $this->libs[$lib->id] = $lib;
            return true;
        }
    }

    /**
     * @throws Exception
     */
    public function getAllEntries() : array {
        $libs = array();
        foreach ($this->libs as $label => $lib) {
            $libs[] = $lib->getEntry();
        }
        usort($libs, function ($o1, $o2) {
            return $o1['id'] <=> $o2['id'];
        });
        return $libs;
    }

    public function getAllIds() : array {
        return array_keys($this->libs);
    }
}