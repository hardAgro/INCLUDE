package include.trap.api.prague;

import org.springframework.data.elasticsearch.repository.ElasticsearchRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface PragueRepository extends ElasticsearchRepository<Prague, Long> {

}
