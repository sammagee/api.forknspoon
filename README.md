# Fork & Spoon

**Let us decide** what's for dinner

This is the repository that contains the code for the API. To view the Client code, visit [sammagee/forknspoon](https://github.com/sammagee/forknspoon).

## Setup

This project uses Laravel Sail to minimize setup time, find additional docs here: [https://laravel.com/docs/master/sail](laravel.com/docs/master/sail). Please ensure that you have [Docker Desktop](https://www.docker.com/products/docker-desktop) installed and set up. If working on Windows, please use [WSL2](https://docs.microsoft.com/en-us/windows/wsl/install-win10).

## Usage

Start the server—this should start the server on [`localhost`](http://localhost):

```bash
./vendor/bin/sail up
```

Stop the server:

```bash
./vendor/bin/sail stop
```

## Test

```bash
./vendor/bin/pest
```
