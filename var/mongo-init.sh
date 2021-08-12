#!/bin/bash
set -e;

if [ -n "${MONGO_INITDB_USERNAME:-}" ] && [ -n "${MONGO_INITDB_PASSWORD:-}" ]; then
	"${mongo[@]}" "$MONGO_INITDB_DATABASE" <<-EOJS
		db.createUser({
			user: $(_js_escape "$MONGO_INITDB_USERNAME"),
			pwd: $(_js_escape "$MONGO_INITDB_PASSWORD"),
			roles: [ { role: $(_js_escape readWrite), db: $(_js_escape "$MONGO_INITDB_DATABASE") } ]
			})

		db.createCollection("students")
		db.students.createIndex({
		    "sin": 1
		}, {
		    unique: true
		});
	EOJS
fi
