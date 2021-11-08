<?php
return <<<'JSON'
{
    "vendor": "Ovia Health",
    "author": "Kevin Carwile",
    "description": "Prototype app to manage Employer incentives programs for Ovia apps.",
    "slug": "ovia-incentives",
    "namespace": "Ovia\\Incentives",
    "name": "Ovia Incentives Management",
    "tables": [
        "incentives_useraward",
        "incentives_employerprogramaward",
        "incentives_user",
        "incentives_userprogress",
        "incentives_employerprogram",
        "incentives_employer"
    ],
    "ms_tables": []
}
JSON;
