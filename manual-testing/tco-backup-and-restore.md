Site: ______


## Procedure

#### 1. Log in to cPanel
..and go to softaculous

#### Backup

#### Verify that automatic backups are enabled
..and that all additional files are included (for example .htaccess)

#### FTP: verify backup there
in /softaculous_backups (not under public_html)

#### Remove the next to last line from the db CallRecords table

#### Make a change in the theme

###### Record: Note the change that was made
Removed the "pages" widget

#### FTP: Delete the site
NOTE: Be careful which part of the site you remove

#### Softaculous: Restore the site

#### Go back to the site

###### Expected result: Things are restored to the point before the two deletions


