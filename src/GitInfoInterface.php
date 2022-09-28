<?php

namespace eiriksm\GitInfo;

/**
 * Class GitInfo.
 *
 * @package Drupal\git_info
 */
interface GitInfoInterface {

  /**
   * Gets a short hash of the current revision.
   *
   * Like "e7ccadcb".
   *
   * @return string|false
   *   The hash string or FALSE if there was an error (like for example, there
   *   is no git repo.
   */
  public function getShortHash();

  /**
   * Gets the current version.
   *
   * Will try to get the version from the tag, otherwise it will return "dev"
   *
   * @return string
   *   The version string.
   */
  public function getVersion();

  /**
   * Gets the date of the latest commit.
   * 
   * @deprecated in eiriksm/gitinfo:4.1.0 and is removed from eiriksm/gitinfo:5.0.0.
   *   Use ::getIsoDate() or ::getCustomDate().
   *
   * @return string|false
   *   A date string, or FALSE if there was a problem.
   */
  public function getDate();


  /**
   * Gets the date of the latest commit in RFC#3339 format.
   * 
   * @see DateTimeInterface::RFC3339_EXTENDED
   * 
   * @return string|null
   *   A date string, or NULL if there was a problem.
   */
  public function getRfc3339Date();

  
  /**
   * Gets the date of the latest commit in the specified format.
   * 
   * @see https://www.php.net/manual/en/datetime.format.php
   * 
   * @param string $format
   *   Format accepted by <a href="https://www.php.net/manual/en/datetime.format.php">DateTimeInterface::format()</a>.
   * 
   * @return string|null
   *   A date string, or NULL if there was a problem.
   */
  public function getCustomDate(string $format);
  

  /**
   * Gets the assembled application version string.
   *
   * Like "v.0.0.3.e7ccadcb (2017-03-16 17:03:15)"
   *
   * @return string
   *   A version string. Will return "v.dev." if something is the matter.
   */
  public function getApplicationVersionString();

}
