-- DB size
SELECT SUM(data_length + index_length) / 1024 / 1024 AS 'DB Size' FROM information_schema.tables WHERE table_schema = 'mysql'

SHOW COUNT(*) ERRORS;
SELECT @@error_count;