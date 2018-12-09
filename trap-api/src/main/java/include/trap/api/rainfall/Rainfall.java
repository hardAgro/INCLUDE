package include.trap.api.rainfall;

import java.time.LocalDateTime;

import org.springframework.data.annotation.Id;
import org.springframework.data.elasticsearch.annotations.Document;

import lombok.Data;
import lombok.EqualsAndHashCode;

@Data
@EqualsAndHashCode(of = "id")
@Document(indexName = "rainfall", createIndex = true)
public class Rainfall {

	@Id
	private Long id;

	private LocalDateTime timestamp;

	private String tag;

	private Boolean value;
}
