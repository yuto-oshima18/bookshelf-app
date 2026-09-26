```mermaid
erDiagram
    users {
        bigint_unsigned id PK
        varchar(255) name
        varchar(255) email
        timestamp email_verified_at
        varchar(255) password
        varchar(100) remember_token
        timestamp created_at
        timestamp updated_at
    }
    
    password_reset_tokens {
        varchar(255) email PK
        varchar(255) token
        timestamp created_at
    }
    
    personal_access_tokens {
        bigint_unsigned id PK
        bigint_unsigned tokenable_id
        varchar(255) tokenable_type
        varchar(255) name
        varchar(64) token UK
        text abilities
        timestamp last_used_at
        timestamp expires_at
        timestamp created_at
        timestamp updated_at
    }
    
    failed_jobs {
        bigint_unsigned id PK
        varchar(255) uuid UK
        text connection
        text queue
        longText payload
        longText exception
        timestamp failed_at
    }
    
    books {
        bigint_unsigned id PK
        bigint_unsigned user_id FK
        varchar(255) title
        varchar(255) author
        varchar(13) isbn UK
        date published_date
        varchar(255) description
        varchar(255) image_url
        timestamp created_at
        timestamp updated_at
    }
    
    genres {
        bigint_unsigned id PK
        varchar(255) name UK
        timestamp created_at
        timestamp updated_at
    }
    
    book_genre {
        bigint_unsigned id PK
        bigint_unsigned book_id FK
        bigint_unsigned genre_id FK
        timestamp created_at
        timestamp updated_at
        UNIQUE book_id,genre_id
    }

    reviews {
        bigint_unsigned id PK
        bigint_unsigned book_id FK
        bigint_unsigned user_id FK
        TINYINT rating
        varchar(255) comment
        timestamp created_at
        timestamp updated_at
    }

    book_user {
        bigint_unsigned id PK
        bigint_unsigned book_id FK
        bigint_unsigned user_id FK
        timestamp created_at
        timestamp updated_at
        UNIQUE book_id,user_id
    }

    user_review {
        bigint_unsigned id PK
        bigint_unsigned review_id FK
        bigint_unsigned user_id FK
        timestamp created_at
        timestamp updated_at
        UNIQUE review_id,user_id
    }

    reading_plans {
        bigint_unsigned id PK
        bigint_unsigned user_id FK
        bigint_unsigned book_id FK
        date target_date
        ENUM status
        date completed_at
        timestamp created_at
        timestamp updated_at
        UNIQUE user_id,book_id,target_date
    }

    notifications {
        CHAR(36)_uuid id PK
        varchar(255) type
        bigint_unsigned notifiable_id
        varchar(255) notifiable_type
        text data
        timestamp read_at
        timestamp created_at
        timestamp updated_at
    }

users ||--o{ books : "has many"
books ||--o{ book_genre : "has many"
genres ||--o{ book_genre : "has many"
books ||--o{ reviews : "has many"
users ||--o{ reviews : "has many"
books ||--o{ book_user : "has many"
users ||--o{ book_user : "has many"
users ||--o{ user_review : "has many"
reviews ||--o{ user_review : "has many"
users ||--o{ reading_plans  : "has many"
reading_plans ||--o{ books : "has many"
```