package include.trap.api;

import java.time.LocalDateTime;

import org.springframework.data.annotation.Id;
import org.springframework.data.elasticsearch.annotations.Document;

import lombok.Data;
import lombok.EqualsAndHashCode;

@Data
@EqualsAndHashCode(of = "id")
@Document(indexName = "trap_entry", createIndex = true)
public class TrapEntry {

	@Id
	private Long id;

	private LocalDateTime dateTime;

	private String trapName;

	private Long pragueCount;
}
