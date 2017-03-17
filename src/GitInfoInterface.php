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
   * @return string|bool
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
   * @return string|bool
   *   A date string, or FALSE if there was a problem.
   */
  public function getDate();

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
