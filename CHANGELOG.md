# Changelog

All notable changes to `register-adries` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [Unreleased]

## [1.2.0] - 2022-02-07

### Added
- Add new NEQ operator on RequestConditions
- Add new RegisterRequestBuilder::whereNeq method
- Add support for PHP8

### Deprecated
- Deprecated RegisterRequestBuilder::wherePartial in favor of whereContains

### Removed
- Drop support for PHP < 7.4

## [1.1.0] - 2020-06-19

### Added
- Add property description for Municipality
- Add custom package exceptions
- Add composer check script
- Add RegisterRequestBuilder::resource method to improve genericity

### Changed
- Improve exception messages

## [1.0.0] - 2020-06-10

### Added
- Improve test coverage
- Improve documentation

## [0.2.0] - 2020-06-09

### Added
- Add helper methods RegisterAdries::find*
- Add methods for LIKE conditions
- Add casting to int in array values

### Fixed
- Fix explode of array values
