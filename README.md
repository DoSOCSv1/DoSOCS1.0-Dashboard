SOCSDashboard
======

System Overview
---------------
<div>
  <p>
  The Software Package Data Exchange (SPDX) specification is a formatting standard for communicating the licenses and copyrights associated with a software package. Being able to explicate this information is a required function for operations support system management within an organization.
  </p>
  
  <p>
  SOCSDashboard is a web based system used to manage a repo of SOCS documents. This system allows users to upload packages for scanning, and high defenition editing of those scanned documents.
  </p>
</div>

Current Version
---------------
1.0

License
-------
<ul>
  <li>Source Code: <a href="https://github.com/socstools/SOCSDashboard/blob/master/LICENSE">Apache 2.0</a></li>
</ul>

Copyright
---------
Copyright © 2014 University of Nebraska at Omaha

System Requirements
-------------------
In general, your system should meet <a href="http://www.fossology.org/projects/fossology/wiki/SysConfig">FOSSology's performance recommendations</a>, which depend on the maximum file or package size you intend to scan.

Prerequisites
-----------------
- Python 2.7
- MySQL
- A php environment
- <a href="http://www.fossology.org/">FOSSology</a>
- <a href="http://ninka.turingmachine.org/#sec-3">Ninka</a>

Installation
------------
- Install Prerequisites
- Download and run <a href="https://github.com/zwmcfarland/DoSPDX/blob/master/install.sh">install.sh</a> to the directory you want DoSPDX installed (Note: you may need to change the user name and password fields in install.sh)
- Update settings.py with database connection information, and install locations of ninka and fossology.

This will install <a href="https://github.com/socstools/DoSOCS">DoSPDX</a>, <a href="https://github.com/socstools/SOCSDashboard">SOCSDashboard</a>, and <a href="https://github.com/socstools/SOCSDatabase">SOCS Database</a>. Also ensure you have execute rights on ninka and fossology.
