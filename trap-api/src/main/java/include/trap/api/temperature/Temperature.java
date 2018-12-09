package include.trap.api.temperature;

import java.time.LocalDateTime;

import org.springframework.data.annotation.Id;
import org.springframework.data.elasticsearch.annotations.Document;

import lombok.Data;
import lombok.EqualsAndHashCode;

@Data
@EqualsAndHashCode(of = "id")
@Document(indexName = "temperature", createIndex = true)
public class Temperature {

	@Id
	private Long id;

	private LocalDateTime timestamp;

	private String tag;

	private Double value;
}
