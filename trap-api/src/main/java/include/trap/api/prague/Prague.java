package include.trap.api.prague;

import java.time.LocalDateTime;

import org.springframework.data.annotation.Id;
import org.springframework.data.elasticsearch.annotations.Document;

import lombok.Data;
import lombok.EqualsAndHashCode;

@Data
@EqualsAndHashCode(of = "id")
@Document(indexName = "prague", createIndex = true)
public class Prague {

	@Id
	private Long id;

	private LocalDateTime timestamp;

	private String tag;

	private Long value;
}
