<?php
return <<<'JSON'
{
    "framework_version": "2.2.15",
    "framework_bundled": true,
    "tables": [
        {
            "name": "incentives_useraward",
            "columns": {
                "id": {
                    "allow_null": false,
                    "auto_increment": true,
                    "binary": false,
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 20,
                    "name": "id",
                    "type": "BIGINT",
                    "unsigned": true,
                    "values": [],
                    "zerofill": false
                },
                "user_id": {
                    "allow_null": true,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 20,
                    "name": "user_id",
                    "type": "VARCHAR",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                },
                "employer_program_award_id": {
                    "allow_null": false,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": "",
                    "length": 255,
                    "name": "employer_program_award_id",
                    "type": "VARCHAR",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                },
                "status": {
                    "allow_null": false,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": "pending",
                    "length": 20,
                    "name": "status",
                    "type": "VARCHAR",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                }
            },
            "indexes": {
                "PRIMARY": {
                    "type": "primary",
                    "name": "PRIMARY",
                    "length": [
                        null
                    ],
                    "columns": [
                        "id"
                    ]
                },
                "user_award_status": {
                    "type": "key",
                    "name": "user_award_status",
                    "length": [
                        null,
                        null
                    ],
                    "columns": [
                        "user_id",
                        "status"
                    ]
                }
            }
        },
        {
            "name": "incentives_employerprogramaward",
            "columns": {
                "id": {
                    "allow_null": false,
                    "auto_increment": true,
                    "binary": false,
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 20,
                    "name": "id",
                    "type": "BIGINT",
                    "unsigned": true,
                    "values": [],
                    "zerofill": false
                },
                "title": {
                    "allow_null": true,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 255,
                    "name": "title",
                    "type": "VARCHAR",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                },
                "employer_program_id": {
                    "allow_null": false,
                    "auto_increment": false,
                    "binary": false,
                    "comment": "",
                    "decimals": null,
                    "default": "",
                    "length": 20,
                    "name": "employer_program_id",
                    "type": "INT",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                },
                "award_key": {
                    "allow_null": true,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 20,
                    "name": "award_key",
                    "type": "VARCHAR",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                },
                "config": {
                    "allow_null": true,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 0,
                    "name": "config",
                    "type": "TEXT",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                }
            },
            "indexes": {
                "PRIMARY": {
                    "type": "primary",
                    "name": "PRIMARY",
                    "length": [
                        null
                    ],
                    "columns": [
                        "id"
                    ]
                },
                "employer_program_id": {
                    "type": "key",
                    "name": "employer_program_id",
                    "length": [
                        null
                    ],
                    "columns": [
                        "employer_program_id"
                    ]
                }
            }
        },
        {
            "name": "incentives_user",
            "columns": {
                "user_id": {
                    "allow_null": false,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": "",
                    "length": 20,
                    "name": "user_id",
                    "type": "VARCHAR",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                },
                "employer_id": {
                    "allow_null": false,
                    "auto_increment": false,
                    "binary": false,
                    "comment": "",
                    "decimals": null,
                    "default": "0",
                    "length": 20,
                    "name": "employer_id",
                    "type": "INT",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                }
            },
            "indexes": {
                "PRIMARY": {
                    "type": "primary",
                    "name": "PRIMARY",
                    "length": [
                        null
                    ],
                    "columns": [
                        "user_id"
                    ]
                }
            }
        },
        {
            "name": "incentives_userprogress",
            "columns": {
                "id": {
                    "allow_null": false,
                    "auto_increment": true,
                    "binary": false,
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 20,
                    "name": "id",
                    "type": "BIGINT",
                    "unsigned": true,
                    "values": [],
                    "zerofill": false
                },
                "user_id": {
                    "allow_null": true,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 20,
                    "name": "user_id",
                    "type": "VARCHAR",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                },
                "employer_program_id": {
                    "allow_null": false,
                    "auto_increment": false,
                    "binary": false,
                    "comment": "",
                    "decimals": null,
                    "default": "",
                    "length": 11,
                    "name": "employer_program_id",
                    "type": "INT",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                },
                "status": {
                    "allow_null": false,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": "in_progress",
                    "length": 15,
                    "name": "status",
                    "type": "VARCHAR",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                },
                "data": {
                    "allow_null": true,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 0,
                    "name": "data",
                    "type": "TEXT",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                }
            },
            "indexes": {
                "PRIMARY": {
                    "type": "primary",
                    "name": "PRIMARY",
                    "length": [
                        null
                    ],
                    "columns": [
                        "id"
                    ]
                },
                "user_progress": {
                    "type": "key",
                    "name": "user_progress",
                    "length": [
                        null,
                        null,
                        null
                    ],
                    "columns": [
                        "user_id",
                        "employer_program_id",
                        "status"
                    ]
                }
            }
        },
        {
            "name": "incentives_employerprogram",
            "columns": {
                "id": {
                    "allow_null": false,
                    "auto_increment": true,
                    "binary": false,
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 20,
                    "name": "id",
                    "type": "BIGINT",
                    "unsigned": true,
                    "values": [],
                    "zerofill": false
                },
                "title": {
                    "allow_null": true,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 255,
                    "name": "title",
                    "type": "VARCHAR",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                },
                "employer_id": {
                    "allow_null": true,
                    "auto_increment": false,
                    "binary": false,
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 20,
                    "name": "employer_id",
                    "type": "INT",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                },
                "program_key": {
                    "allow_null": true,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 20,
                    "name": "program_key",
                    "type": "VARCHAR",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                },
                "config": {
                    "allow_null": true,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 0,
                    "name": "config",
                    "type": "TEXT",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                }
            },
            "indexes": {
                "PRIMARY": {
                    "type": "primary",
                    "name": "PRIMARY",
                    "length": [
                        null
                    ],
                    "columns": [
                        "id"
                    ]
                },
                "employer_id": {
                    "type": "key",
                    "name": "employer_id",
                    "length": [
                        null
                    ],
                    "columns": [
                        "employer_id"
                    ]
                }
            }
        },
        {
            "name": "incentives_employer",
            "columns": {
                "id": {
                    "allow_null": false,
                    "auto_increment": true,
                    "binary": false,
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 20,
                    "name": "id",
                    "type": "BIGINT",
                    "unsigned": true,
                    "values": [],
                    "zerofill": false
                },
                "title": {
                    "allow_null": true,
                    "auto_increment": false,
                    "binary": false,
                    "collation": "utf8mb4_unicode_ci",
                    "comment": "",
                    "decimals": null,
                    "default": null,
                    "length": 255,
                    "name": "title",
                    "type": "VARCHAR",
                    "unsigned": false,
                    "values": [],
                    "zerofill": false
                }
            },
            "indexes": {
                "PRIMARY": {
                    "type": "primary",
                    "name": "PRIMARY",
                    "length": [
                        null
                    ],
                    "columns": [
                        "id"
                    ]
                }
            }
        }
    ]
}
JSON;
