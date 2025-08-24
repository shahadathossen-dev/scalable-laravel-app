#!/bin/bash
set -e
ACTIVITY_DB="${POSTGRESQL_ACTIVITY_DATABASE}"

echo "Creating Activity database: $ACTIVITY_DB"

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" <<-EOSQL
    -- Create activity database
    CREATE DATABASE "$ACTIVITY_DB";
EOSQL
