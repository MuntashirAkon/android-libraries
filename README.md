# Android Libraries

A list of Android libraries and/or trackers along with classification such as type, categories and ant-features.

**Development Status:** Still in progress. Nothing is stable right now. DO NOT use this in your project. If you're
interested in this project, you can watch the releases instead.

## JSON Schema

Each item in the array contain the following information. Data types are enclosed in first bracket and optional entries
are marked as _optional_. Dot notation is used for the attributes of an object.

- `version` (integer) - Schema version, currently `1`
- `id` (string) - Unique ID, for easy reference and future use
- `exodus_id` (integer) _optional_ - Exodus ID [Not present = Unavailable in the Exodus]
- `etip_id` (string) _optional_ - ETIP ID [Not present = Unavailable in ETIP]
- `label` (string) - Label (should be unique in our dependencies: ETIP, Exodus, LibSmali, etc.)
- `description` (string) _optional_ - Description of the library/tracker
- `signatures` (object) - Signature object containing code, network and solib signatures
- `signatures.code` (regex) _optional_
- `signatures.network` (regex) _optional_
- `signatures.solib` (regex) _optional_
- `signatures.filename` (regex) _optional_ - Match file names in the APK/zip file
- `signatures.file` (regex) _optional_ - Match relative file paths in the APK/zip file
- `signatures.meta` (regex) _optional_ - Match meta-data inside `application` tag in AndroidManifest.xml
- `website` (string) _optional_
- `type` (string) - Type as specified in libradar
- `tags` (string[]) _optional_ - A list of tags
- `group_id` (string) _optional_ - Maven group ID
- `artifact_id` (string) _optional_ - Maven artifact ID
- `anti_features` (string[]) _optional_ - AntiFeatures as specified by F-Droid (for ETIP, if it cannot be inferred from
  categories, both Tracking and Ads will be used) [not present = Unknown, empty array = No AntiFeatures and so on ]
- `license` (string) _optional_ SPDX license identifiers with support for `AND` (higher precedence) and `OR` (lower
  precedence) but no complex patterns with brackets. In case of a non-SPDX but somewhat common license (which should be
  very rare), we may define a common identifier ourselves.

  | Name                                  | Description                                                                                              |
  |---------------------------------------|----------------------------------------------------------------------------------------------------------|
  | Not present                           | Unknown                                                                                                  |
  | empty                                 | License unset (Should automatically be inferred as proprietary)                                          |
  | `Proprietary`                         | Uncommon/Unknown proprietary license                                                                     |
  | `Non-SPDX AND <License-Identifier>`   | Common non-SPDX license `<License-Identifier>` defined by us                                             |
  | `Custom AND <SPDX-License-Identifer>` | Custom license based on a SPDX license (provided both are of the same type e.g. both open source license |

  Examples:
    1. `GPL-3.0-only OR Apache-2.0` - The library is dual licensed under two mutually exclusive licenses
    2. `Custom AND MIT` - MIT-based custom license
- `dead_since` (date) _optional_ - Approximate date when the library was dead. `0` if the date is not known and omitted
  if the library is active.
- `verified` (boolean) _optional_ - Whether the entry was verified by the maintainers and the ID (above) is stable i.e.
  the ID will not be changed across updates
- `last_update` (date) - Last update date
- `comment` (string) _optional_ - Note/comment for internal use

## Credits

- [IzzyOnDroid](https://android.izzysoft.de/)
- [Exodus Privacy](https://exodus-privacy.eu.org)
- @gnuhead-chieb

## License

```
Copyright (C) 2022  Muntashir Al-Islam

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
```