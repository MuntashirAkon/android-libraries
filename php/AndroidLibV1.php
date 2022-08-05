<?php
// SPDX-License-Identifier: AGPL-3.0-or-later

require_once __DIR__ . '/library_types.php';

class AndroidLibV1 {
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
        $entry = [
            'version' => 1,
            'id' => $this->id,
            'label' => $this->label,
            'type' => $this->type,
            'signatures' => array(),
            'last_update' => $this->last_update != 0 ? $this->last_update : date_create()->format('Uv')
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
