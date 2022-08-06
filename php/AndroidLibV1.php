<?php
// SPDX-License-Identifier: AGPL-3.0-or-later

require_once __DIR__ . '/library_types.php';

class AndroidLibV1 {
    public static function fromJson($json_lib) : AndroidLibV1 {
        $lib = new AndroidLibV1();
        $lib->id = $json_lib['id'];
        $lib->exodus_id = $json_lib['exodus_id'] ?? null;
        $lib->etip_id = $json_lib['etip_id'] ?? null;
        $lib->label = $json_lib['label'];
        $lib->type = $json_lib['type'];
        $lib->tags = $json_lib['tags'] ?? null;
        $lib->code_signatures = $json_lib['signatures']['code'] ?? null;
        $lib->network_signatures = $json_lib['signatures']['network'] ?? null;
        $lib->solib_signatures = $json_lib['signatures']['solib'] ?? null;
        $lib->file_signatures = $json_lib['signatures']['file'] ?? null;
        $lib->filename_signatures = $json_lib['signatures']['filename'] ?? null;
        $lib->meta_signatures = $json_lib['signatures']['meta'] ?? null;
        $lib->website = $json_lib['website'] ?? null;
        $lib->description = $json_lib['description'] ?? null;
        $lib->group_id = $json_lib['group_id'] ?? null;
        $lib->artifact_id = $json_lib['artifact_id'] ?? null;
        $lib->license = $json_lib['license'] ?? null;
        $lib->anti_features = $json_lib['anti_features'] ?? null;
        $lib->dead_since = $json_lib['dead_since'] ?? null;
        $lib->verified = $json_lib['verified'] ?? null;
        $lib->last_update = $json_lib['last_update'];
        $lib->comment = $json_lib['comment'] ?? null;
        return $lib;
    }

    public string $id;
    public ?int $exodus_id = null;
    public ?string $etip_id = null;
    public string $label;
    public string $type;
    public ?array $tags = null;
    public ?string $code_signatures = null;
    public ?string $network_signatures = null;
    public ?string $solib_signatures = null;
    public ?string $file_signatures = null;
    public ?string $filename_signatures = null;
    public ?string $meta_signatures = null;
    public ?string $website = null;
    public ?string $description = null;
    public ?string $group_id = null;
    public ?string $artifact_id = null;
    public ?string $license = null;
    public ?array $anti_features = null;
    public ?int $dead_since = null;
    public ?bool $verified = null;
    public int $last_update = 0;
    public ?string $comment = null;

    /**
     * @throws Exception
     */
    public function getEntry() : array {
        if (!in_array($this->type, LIBRARY_TYPES)) {
            throw new Exception("Invalid type: {$this->type}", 1);
        }
        if ($this->code_signatures == null
            && $this->network_signatures == null
            && $this->solib_signatures == null
            && $this->filename_signatures == null
            && $this->file_signatures == null
            && $this->meta_signatures == null) {
            throw new Exception("At least one item is required for signatures", 1);
        }
        // TODO: Check if Ant-Features matched
        // Make entry
        if ($this->last_update == 0) {
            $this->last_update = (int) date_create()->format('Uv');
        }
        $entry = [
            'version' => 1,
            'id' => $this->id,
            'label' => $this->label,
            'type' => $this->type,
            'signatures' => array(),
            'last_update' => $this->last_update
        ];
        if ($this->code_signatures != null) $entry['signatures']['code'] = $this->code_signatures;
        if ($this->network_signatures != null) $entry['signatures']['network'] = $this->network_signatures;
        if ($this->solib_signatures != null) $entry['signatures']['solib'] = $this->solib_signatures;
        if ($this->filename_signatures != null) $entry['signatures']['filename'] = $this->filename_signatures;
        if ($this->file_signatures != null) $entry['signatures']['file'] = $this->file_signatures;
        if ($this->meta_signatures != null) $entry['signatures']['meta'] = $this->meta_signatures;
        if ($this->website != null) $entry['website'] = $this->website;
        if ($this->description != null) $entry['description'] = $this->description;
        if ($this->group_id != null) $entry['group_id'] = $this->group_id;
        if ($this->artifact_id != null) $entry['artifact_id'] = $this->artifact_id;
        if ($this->license != null) $entry['license'] = $this->license;
        if ($this->anti_features != null) $entry['anti_features'] = $this->anti_features;
        if ($this->exodus_id != null) $entry['exodus_id'] = $this->exodus_id;
        if ($this->etip_id != null) $entry['etip_id'] = $this->etip_id;
        if ($this->dead_since != null) $entry['dead_since'] = $this->dead_since;
        if ($this->verified != null) $entry['verified'] = $this->verified;
        if ($this->comment != null) $entry['comment'] = $this->comment;
        if ($this->tags != null) $entry['tags'] = $this->tags;
        return $entry;
    }
}
